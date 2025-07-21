using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ShopNest.Data;
using ShopNest.Models;

namespace ShopNest.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class CartController : ControllerBase
    {
        private readonly ShopNestDbContext _context;

        public CartController(ShopNestDbContext context)
        {
            _context = context;
        }

        [HttpGet("{userId}")]
        public async Task<IActionResult> GetCart(int userId)
        {
            var cartItems = await _context.CartItems
                .Include(ci => ci.Product)
                .ThenInclude(p => p.ProductImages)
                .Where(ci => ci.UserId == userId)
                .Select(ci => new
                {
                    ci.CartItemId,
                    ci.ProductId,
                    ci.Quantity,
                    Product = new
                    {
                        ci.Product.ProductId,
                        ci.Product.Name,
                        ci.Product.Price,
                        ci.Product.DiscountPrice,
                        ci.Product.StockQuantity,
                        PrimaryImage = ci.Product.ProductImages.FirstOrDefault(img => img.IsPrimary)!.ImageUrl
                    },
                    TotalPrice = ci.Quantity * (ci.Product.DiscountPrice ?? ci.Product.Price)
                })
                .ToListAsync();

            var totalAmount = cartItems.Sum(ci => ci.TotalPrice);

            return Ok(new
            {
                cartItems,
                totalAmount,
                itemCount = cartItems.Count
            });
        }

        [HttpPost("add")]
        public async Task<IActionResult> AddToCart([FromBody] AddToCartRequest request)
        {
            // Kiểm tra sản phẩm có tồn tại không
            var product = await _context.Products.FindAsync(request.ProductId);
            if (product == null || !product.IsActive)
            {
                return NotFound("Sản phẩm không tồn tại");
            }

            // Kiểm tra số lượng tồn kho
            if (product.StockQuantity < request.Quantity)
            {
                return BadRequest($"Số lượng tồn kho không đủ. Chỉ còn {product.StockQuantity} sản phẩm");
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            var existingCartItem = await _context.CartItems
                .FirstOrDefaultAsync(ci => ci.UserId == request.UserId && ci.ProductId == request.ProductId);

            if (existingCartItem != null)
            {
                // Cập nhật số lượng
                existingCartItem.Quantity += request.Quantity;
                existingCartItem.UpdatedAt = DateTime.UtcNow;
            }
            else
            {
                // Thêm mới vào giỏ hàng
                var cartItem = new CartItem
                {
                    UserId = request.UserId,
                    ProductId = request.ProductId,
                    Quantity = request.Quantity
                };
                _context.CartItems.Add(cartItem);
            }

            await _context.SaveChangesAsync();

            return Ok(new { message = "Thêm vào giỏ hàng thành công" });
        }

        [HttpPut("update")]
        public async Task<IActionResult> UpdateCartItem([FromBody] UpdateCartRequest request)
        {
            var cartItem = await _context.CartItems
                .Include(ci => ci.Product)
                .FirstOrDefaultAsync(ci => ci.CartItemId == request.CartItemId);

            if (cartItem == null)
            {
                return NotFound("Sản phẩm không có trong giỏ hàng");
            }

            // Kiểm tra số lượng tồn kho
            if (cartItem.Product.StockQuantity < request.Quantity)
            {
                return BadRequest($"Số lượng tồn kho không đủ. Chỉ còn {cartItem.Product.StockQuantity} sản phẩm");
            }

            cartItem.Quantity = request.Quantity;
            cartItem.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Cập nhật giỏ hàng thành công" });
        }

        [HttpDelete("{cartItemId}")]
        public async Task<IActionResult> RemoveFromCart(int cartItemId)
        {
            var cartItem = await _context.CartItems.FindAsync(cartItemId);
            if (cartItem == null)
            {
                return NotFound("Sản phẩm không có trong giỏ hàng");
            }

            _context.CartItems.Remove(cartItem);
            await _context.SaveChangesAsync();

            return Ok(new { message = "Xóa khỏi giỏ hàng thành công" });
        }

        [HttpDelete("clear/{userId}")]
        public async Task<IActionResult> ClearCart(int userId)
        {
            var cartItems = await _context.CartItems
                .Where(ci => ci.UserId == userId)
                .ToListAsync();

            _context.CartItems.RemoveRange(cartItems);
            await _context.SaveChangesAsync();

            return Ok(new { message = "Xóa toàn bộ giỏ hàng thành công" });
        }
    }

    public class AddToCartRequest
    {
        public int UserId { get; set; }
        public int ProductId { get; set; }
        public int Quantity { get; set; }
    }

    public class UpdateCartRequest
    {
        public int CartItemId { get; set; }
        public int Quantity { get; set; }
    }
}
