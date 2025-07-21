using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ShopNest.Data;
using ShopNest.Models;

namespace ShopNest.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class OrderController : ControllerBase
    {
        private readonly ShopNestDbContext _context;

        public OrderController(ShopNestDbContext context)
        {
            _context = context;
        }

        [HttpGet("user/{userId}")]
        public async Task<IActionResult> GetUserOrders(int userId, [FromQuery] int page = 1, [FromQuery] int pageSize = 10)
        {
            var query = _context.Orders
                .Include(o => o.OrderItems)
                .ThenInclude(oi => oi.Product)
                .Where(o => o.CustomerId == userId);

            var totalItems = await query.CountAsync();
            var orders = await query
                .OrderByDescending(o => o.CreatedAt)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .Select(o => new
                {
                    o.OrderId,
                    o.OrderNumber,
                    o.Status,
                    o.TotalAmount,
                    o.ShippingAddress,
                    o.CreatedAt,
                    ItemCount = o.OrderItems.Count,
                    Items = o.OrderItems.Select(oi => new
                    {
                        oi.OrderItemId,
                        oi.ProductId,
                        oi.Quantity,
                        oi.UnitPrice,
                        ProductName = oi.Product.Name
                    })
                })
                .ToListAsync();

            return Ok(new
            {
                orders,
                totalItems,
                totalPages = (int)Math.Ceiling((double)totalItems / pageSize),
                currentPage = page
            });
        }

        [HttpGet("{orderId}")]
        public async Task<IActionResult> GetOrder(int orderId)
        {
            var order = await _context.Orders
                .Include(o => o.Customer)
                .Include(o => o.OrderItems)
                .ThenInclude(oi => oi.Product)
                .ThenInclude(p => p.ProductImages)
                .Where(o => o.OrderId == orderId)
                .Select(o => new
                {
                    o.OrderId,
                    o.OrderNumber,
                    o.Status,
                    o.TotalAmount,
                    o.ShippingAddress,
                    o.PaymentMethod,
                    o.PaymentStatus,
                    o.CreatedAt,
                    Customer = new
                    {
                        o.Customer.UserId,
                        o.Customer.FirstName,
                        o.Customer.LastName,
                        o.Customer.Email,
                        o.Customer.PhoneNumber
                    },
                    Items = o.OrderItems.Select(oi => new
                    {
                        oi.OrderItemId,
                        oi.ProductId,
                        oi.Quantity,
                        oi.UnitPrice,
                        TotalPrice = oi.Quantity * oi.UnitPrice,
                        Product = new
                        {
                            oi.Product.ProductId,
                            oi.Product.Name,
                            oi.Product.SKU,
                            PrimaryImage = oi.Product.ProductImages.FirstOrDefault(img => img.IsPrimary)!.ImageUrl
                        }
                    })
                })
                .FirstOrDefaultAsync();

            if (order == null)
            {
                return NotFound("Đơn hàng không tồn tại");
            }

            return Ok(order);
        }

        [HttpPost("create")]
        public async Task<IActionResult> CreateOrder([FromBody] CreateOrderRequest request)
        {
            using var transaction = await _context.Database.BeginTransactionAsync();
            try
            {
                // Lấy giỏ hàng của user
                var cartItems = await _context.CartItems
                    .Include(ci => ci.Product)
                    .Where(ci => ci.UserId == request.CustomerId)
                    .ToListAsync();

                if (!cartItems.Any())
                {
                    return BadRequest("Giỏ hàng trống");
                }

                // Kiểm tra tồn kho
                foreach (var item in cartItems)
                {
                    if (item.Product.StockQuantity < item.Quantity)
                    {
                        return BadRequest($"Sản phẩm {item.Product.Name} không đủ tồn kho");
                    }
                }

                // Tạo đơn hàng
                var order = new Order
                {
                    OrderNumber = GenerateOrderNumber(),
                    CustomerId = request.CustomerId,
                    Status = OrderStatus.Pending,
                    TotalAmount = cartItems.Sum(ci => ci.Quantity * (ci.Product.DiscountPrice ?? ci.Product.Price)),
                    ShippingAddress = request.ShippingAddress,
                    PaymentMethod = request.PaymentMethod,
                    PaymentStatus = PaymentStatus.Pending
                };

                _context.Orders.Add(order);
                await _context.SaveChangesAsync();

                // Tạo order items và cập nhật tồn kho
                foreach (var cartItem in cartItems)
                {
                    var orderItem = new OrderItem
                    {
                        OrderId = order.OrderId,
                        ProductId = cartItem.ProductId,
                        Quantity = cartItem.Quantity,
                        UnitPrice = cartItem.Product.DiscountPrice ?? cartItem.Product.Price
                    };
                    _context.OrderItems.Add(orderItem);

                    // Giảm tồn kho
                    cartItem.Product.StockQuantity -= cartItem.Quantity;
                }

                // Xóa giỏ hàng
                _context.CartItems.RemoveRange(cartItems);

                await _context.SaveChangesAsync();
                await transaction.CommitAsync();

                return Ok(new { message = "Tạo đơn hàng thành công", orderId = order.OrderId, orderNumber = order.OrderNumber });
            }
            catch
            {
                await transaction.RollbackAsync();
                return StatusCode(500, "Có lỗi xảy ra khi tạo đơn hàng");
            }
        }

        [HttpPut("{orderId}/status")]
        public async Task<IActionResult> UpdateOrderStatus(int orderId, [FromBody] UpdateOrderStatusRequest request)
        {
            var order = await _context.Orders.FindAsync(orderId);
            if (order == null)
            {
                return NotFound("Đơn hàng không tồn tại");
            }

            order.Status = request.Status;
            order.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Cập nhật trạng thái đơn hàng thành công" });
        }

        [HttpPut("{orderId}/cancel")]
        public async Task<IActionResult> CancelOrder(int orderId)
        {
            var order = await _context.Orders
                .Include(o => o.OrderItems)
                .ThenInclude(oi => oi.Product)
                .FirstOrDefaultAsync(o => o.OrderId == orderId);

            if (order == null)
            {
                return NotFound("Đơn hàng không tồn tại");
            }

            if (order.Status != OrderStatus.Pending)
            {
                return BadRequest("Chỉ có thể hủy đơn hàng đang chờ xử lý");
            }

            // Hoàn lại tồn kho
            foreach (var item in order.OrderItems)
            {
                item.Product.StockQuantity += item.Quantity;
            }

            order.Status = OrderStatus.Cancelled;
            order.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Hủy đơn hàng thành công" });
        }

        private string GenerateOrderNumber()
        {
            return $"SN{DateTime.Now:yyyyMMddHHmmss}{new Random().Next(1000, 9999)}";
        }
    }

    public class CreateOrderRequest
    {
        public int CustomerId { get; set; }
        public string ShippingAddress { get; set; } = string.Empty;
        public PaymentMethod PaymentMethod { get; set; }
    }

    public class UpdateOrderStatusRequest
    {
        public OrderStatus Status { get; set; }
    }
}
