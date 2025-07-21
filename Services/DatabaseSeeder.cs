using ShopNest.Data;
using ShopNest.Models;
using BCrypt.Net;

namespace ShopNest.Services
{
    public class DatabaseSeeder
    {
        private readonly ShopNestDbContext _context;

        public DatabaseSeeder(ShopNestDbContext context)
        {
            _context = context;
        }

        public async Task SeedAsync()
        {
            // Kiểm tra xem đã có dữ liệu chưa
            if (_context.Users.Any())
            {
                return; // Đã có dữ liệu
            }

            // Tạo users mẫu
            var admin = new User
            {
                Username = "admin",
                Email = "admin@shopnest.com",
                PasswordHash = BCrypt.Net.BCrypt.HashPassword("admin123"),
                FirstName = "Admin",
                LastName = "ShopNest",
                Role = UserRole.Admin,
                IsActive = true
            };

            var seller = new User
            {
                Username = "seller1",
                Email = "seller1@shopnest.com",
                PasswordHash = BCrypt.Net.BCrypt.HashPassword("seller123"),
                FirstName = "Người bán",
                LastName = "Số 1",
                Role = UserRole.Seller,
                IsActive = true,
                PhoneNumber = "0123456789",
                Address = "123 Đường ABC, TP.HCM"
            };

            var customer = new User
            {
                Username = "customer1",
                Email = "customer1@shopnest.com",
                PasswordHash = BCrypt.Net.BCrypt.HashPassword("customer123"),
                FirstName = "Khách hàng",
                LastName = "Số 1",
                Role = UserRole.Customer,
                IsActive = true,
                PhoneNumber = "0987654321",
                Address = "456 Đường XYZ, TP.HCM"
            };

            _context.Users.AddRange(admin, seller, customer);
            await _context.SaveChangesAsync();

            // Tạo brands mẫu
            var apple = new Brand
            {
                Name = "Apple",
                Description = "Thương hiệu công nghệ nổi tiếng",
                IsActive = true
            };

            var samsung = new Brand
            {
                Name = "Samsung",
                Description = "Thương hiệu điện tử Hàn Quốc",
                IsActive = true
            };

            _context.Brands.AddRange(apple, samsung);
            await _context.SaveChangesAsync();

            // Tạo categories mẫu
            var electronics = new Category
            {
                Name = "Điện tử",
                Description = "Các sản phẩm điện tử",
                IsActive = true
            };

            _context.Categories.Add(electronics);
            await _context.SaveChangesAsync();

            var phones = new Category
            {
                Name = "Điện thoại",
                Description = "Điện thoại thông minh",
                ParentCategoryId = electronics.CategoryId,
                IsActive = true
            };

            var laptops = new Category
            {
                Name = "Laptop",
                Description = "Máy tính xách tay",
                ParentCategoryId = electronics.CategoryId,
                IsActive = true
            };

            _context.Categories.AddRange(phones, laptops);
            await _context.SaveChangesAsync();

            // Tạo products mẫu
            var iphone15 = new Product
            {
                Name = "iPhone 15 Pro Max",
                Description = "Điện thoại iPhone 15 Pro Max mới nhất với chip A17 Pro",
                Price = 29990000,
                DiscountPrice = 28990000,
                StockQuantity = 50,
                SKU = "IP15PM-256GB",
                CategoryId = phones.CategoryId,
                BrandId = apple.BrandId,
                SellerId = seller.UserId,
                Status = ProductStatus.Approved,
                IsActive = true
            };

            var galaxy24 = new Product
            {
                Name = "Samsung Galaxy S24 Ultra",
                Description = "Điện thoại Samsung Galaxy S24 Ultra với S Pen",
                Price = 25990000,
                DiscountPrice = 24990000,
                StockQuantity = 30,
                SKU = "SGS24U-512GB",
                CategoryId = phones.CategoryId,
                BrandId = samsung.BrandId,
                SellerId = seller.UserId,
                Status = ProductStatus.Approved,
                IsActive = true
            };

            _context.Products.AddRange(iphone15, galaxy24);
            await _context.SaveChangesAsync();

            // Tạo product images mẫu
            var iphoneImage = new ProductImage
            {
                ProductId = iphone15.ProductId,
                ImageUrl = "https://example.com/iphone15.jpg",
                AltText = "iPhone 15 Pro Max",
                IsPrimary = true,
                DisplayOrder = 1
            };

            var galaxyImage = new ProductImage
            {
                ProductId = galaxy24.ProductId,
                ImageUrl = "https://example.com/galaxy24.jpg",
                AltText = "Samsung Galaxy S24 Ultra",
                IsPrimary = true,
                DisplayOrder = 1
            };

            _context.ProductImages.AddRange(iphoneImage, galaxyImage);
            await _context.SaveChangesAsync();

            // Tạo promotion mẫu
            var newYearPromo = new Promotion
            {
                Name = "Khuyến mãi năm mới",
                Description = "Giảm giá 10% cho tất cả sản phẩm",
                Type = PromotionType.Percentage,
                Value = 10,
                MinOrderAmount = 1000000,
                MaxDiscountAmount = 2000000,
                StartDate = DateTime.UtcNow,
                EndDate = DateTime.UtcNow.AddDays(30),
                UsageLimit = 100,
                IsActive = true
            };

            _context.Promotions.Add(newYearPromo);
            await _context.SaveChangesAsync();

            // Tạo promotion code mẫu
            var promoCode = new PromotionCode
            {
                PromotionId = newYearPromo.PromotionId,
                Code = "NEWYEAR2025",
                UsageLimit = 50,
                IsActive = true
            };

            _context.PromotionCodes.Add(promoCode);
            await _context.SaveChangesAsync();

            Console.WriteLine("Seed data đã được tạo thành công!");
        }
    }
}
