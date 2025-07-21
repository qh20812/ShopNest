using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ShopNest.Data;
using ShopNest.Models;

namespace ShopNest.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ProductController : ControllerBase
    {
        private readonly ShopNestDbContext _context;

        public ProductController(ShopNestDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetProducts([FromQuery] int page = 1, [FromQuery] int pageSize = 10, [FromQuery] string? search = null)
        {
            var query = _context.Products
                .Include(p => p.Category)
                .Include(p => p.Brand)
                .Include(p => p.ProductImages)
                .Where(p => p.IsActive && p.Status == ProductStatus.Approved);

            if (!string.IsNullOrEmpty(search))
            {
                query = query.Where(p => p.Name.Contains(search) || (p.Description != null && p.Description.Contains(search)));
            }

            var totalItems = await query.CountAsync();
            var products = await query
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .Select(p => new
                {
                    p.ProductId,
                    p.Name,
                    p.Description,
                    p.Price,
                    p.DiscountPrice,
                    p.StockQuantity,
                    p.SKU,
                    Category = p.Category!.Name,
                    Brand = p.Brand!.Name,
                    PrimaryImage = p.ProductImages.FirstOrDefault(img => img.IsPrimary)!.ImageUrl
                })
                .ToListAsync();

            return Ok(new
            {
                products,
                totalItems,
                totalPages = (int)Math.Ceiling((double)totalItems / pageSize),
                currentPage = page
            });
        }

        [HttpGet("{id}")]
        public async Task<IActionResult> GetProduct(int id)
        {
            var product = await _context.Products
                .Include(p => p.Category)
                .Include(p => p.Brand)
                .Include(p => p.ProductImages)
                .Include(p => p.Reviews)
                .Where(p => p.ProductId == id && p.IsActive)
                .Select(p => new
                {
                    p.ProductId,
                    p.Name,
                    p.Description,
                    p.Price,
                    p.DiscountPrice,
                    p.StockQuantity,
                    p.SKU,
                    p.Status,
                    Category = new { p.Category!.CategoryId, p.Category.Name },
                    Brand = new { p.Brand!.BrandId, p.Brand.Name },
                    Images = p.ProductImages.Select(img => new { img.ImageId, img.ImageUrl, img.AltText, img.IsPrimary }),
                    Reviews = p.Reviews.Select(r => new { r.ReviewId, r.Rating, r.Comment, r.CreatedAt })
                })
                .FirstOrDefaultAsync();

            if (product == null)
            {
                return NotFound("Sản phẩm không tồn tại");
            }

            return Ok(product);
        }

        [HttpPost]
        public async Task<IActionResult> CreateProduct([FromBody] CreateProductRequest request)
        {
            var product = new Product
            {
                Name = request.Name,
                Description = request.Description,
                Price = request.Price,
                DiscountPrice = request.DiscountPrice,
                StockQuantity = request.StockQuantity,
                SKU = request.SKU,
                CategoryId = request.CategoryId,
                BrandId = request.BrandId,
                SellerId = request.SellerId,
                Status = ProductStatus.Pending,
                IsActive = true
            };

            _context.Products.Add(product);
            await _context.SaveChangesAsync();

            return Ok(new { message = "Tạo sản phẩm thành công", productId = product.ProductId });
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateProduct(int id, [FromBody] UpdateProductRequest request)
        {
            var product = await _context.Products.FindAsync(id);
            if (product == null)
            {
                return NotFound("Sản phẩm không tồn tại");
            }

            product.Name = request.Name;
            product.Description = request.Description;
            product.Price = request.Price;
            product.DiscountPrice = request.DiscountPrice;
            product.StockQuantity = request.StockQuantity;
            product.CategoryId = request.CategoryId;
            product.BrandId = request.BrandId;
            product.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Cập nhật sản phẩm thành công" });
        }

        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteProduct(int id)
        {
            var product = await _context.Products.FindAsync(id);
            if (product == null)
            {
                return NotFound("Sản phẩm không tồn tại");
            }

            product.IsActive = false;
            product.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Xóa sản phẩm thành công" });
        }

        [HttpPost("{id}/approve")]
        public async Task<IActionResult> ApproveProduct(int id)
        {
            var product = await _context.Products.FindAsync(id);
            if (product == null)
            {
                return NotFound("Sản phẩm không tồn tại");
            }

            product.Status = ProductStatus.Approved;
            product.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Duyệt sản phẩm thành công" });
        }
    }

    public class CreateProductRequest
    {
        public string Name { get; set; } = string.Empty;
        public string Description { get; set; } = string.Empty;
        public decimal Price { get; set; }
        public decimal? DiscountPrice { get; set; }
        public int StockQuantity { get; set; }
        public string SKU { get; set; } = string.Empty;
        public int CategoryId { get; set; }
        public int BrandId { get; set; }
        public int SellerId { get; set; }
    }

    public class UpdateProductRequest
    {
        public string Name { get; set; } = string.Empty;
        public string Description { get; set; } = string.Empty;
        public decimal Price { get; set; }
        public decimal? DiscountPrice { get; set; }
        public int StockQuantity { get; set; }
        public int CategoryId { get; set; }
        public int BrandId { get; set; }
    }
}
