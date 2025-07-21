using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ShopNest.Data;
using ShopNest.Models;

namespace ShopNest.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class CategoryController : ControllerBase
    {
        private readonly ShopNestDbContext _context;

        public CategoryController(ShopNestDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetCategories()
        {
            var categories = await _context.Categories
                .Where(c => c.IsActive)
                .Include(c => c.SubCategories)
                .Where(c => c.ParentCategoryId == null)
                .Select(c => new
                {
                    c.CategoryId,
                    c.Name,
                    c.Description,
                    c.ImageUrl,
                    SubCategories = c.SubCategories.Where(sub => sub.IsActive).Select(sub => new
                    {
                        sub.CategoryId,
                        sub.Name,
                        sub.Description,
                        sub.ImageUrl
                    })
                })
                .ToListAsync();

            return Ok(categories);
        }

        [HttpGet("{id}")]
        public async Task<IActionResult> GetCategory(int id)
        {
            var category = await _context.Categories
                .Include(c => c.ParentCategory)
                .Include(c => c.SubCategories)
                .Where(c => c.CategoryId == id && c.IsActive)
                .Select(c => new
                {
                    c.CategoryId,
                    c.Name,
                    c.Description,
                    c.ImageUrl,
                    c.ParentCategoryId,
                    ParentCategory = c.ParentCategory != null ? new { c.ParentCategory.CategoryId, c.ParentCategory.Name } : null,
                    SubCategories = c.SubCategories.Where(sub => sub.IsActive).Select(sub => new
                    {
                        sub.CategoryId,
                        sub.Name,
                        sub.Description
                    })
                })
                .FirstOrDefaultAsync();

            if (category == null)
            {
                return NotFound("Danh mục không tồn tại");
            }

            return Ok(category);
        }

        [HttpPost]
        public async Task<IActionResult> CreateCategory([FromBody] CreateCategoryRequest request)
        {
            var category = new Category
            {
                Name = request.Name,
                Description = request.Description,
                ImageUrl = request.ImageUrl,
                ParentCategoryId = request.ParentCategoryId,
                IsActive = true
            };

            _context.Categories.Add(category);
            await _context.SaveChangesAsync();

            return Ok(new { message = "Tạo danh mục thành công", categoryId = category.CategoryId });
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateCategory(int id, [FromBody] UpdateCategoryRequest request)
        {
            var category = await _context.Categories.FindAsync(id);
            if (category == null)
            {
                return NotFound("Danh mục không tồn tại");
            }

            category.Name = request.Name;
            category.Description = request.Description;
            category.ImageUrl = request.ImageUrl;
            category.ParentCategoryId = request.ParentCategoryId;
            category.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Cập nhật danh mục thành công" });
        }

        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteCategory(int id)
        {
            var category = await _context.Categories.FindAsync(id);
            if (category == null)
            {
                return NotFound("Danh mục không tồn tại");
            }

            // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
            var hasProducts = await _context.Products.AnyAsync(p => p.CategoryId == id && p.IsActive);
            if (hasProducts)
            {
                return BadRequest("Không thể xóa danh mục vì còn sản phẩm thuộc danh mục này");
            }

            category.IsActive = false;
            category.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new { message = "Xóa danh mục thành công" });
        }
    }

    public class CreateCategoryRequest
    {
        public string Name { get; set; } = string.Empty;
        public string? Description { get; set; }
        public string? ImageUrl { get; set; }
        public int? ParentCategoryId { get; set; }
    }

    public class UpdateCategoryRequest
    {
        public string Name { get; set; } = string.Empty;
        public string? Description { get; set; }
        public string? ImageUrl { get; set; }
        public int? ParentCategoryId { get; set; }
    }
}
