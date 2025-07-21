using Microsoft.EntityFrameworkCore;
using ShopNest.Models;

namespace ShopNest.Data
{
    public class ShopNestDbContext : DbContext
    {
        public ShopNestDbContext(DbContextOptions<ShopNestDbContext> options) : base(options)
        {
        }

        // DbSets
        public DbSet<User> Users { get; set; }
        public DbSet<Category> Categories { get; set; }
        public DbSet<Brand> Brands { get; set; }
        public DbSet<Product> Products { get; set; }
        public DbSet<ProductImage> ProductImages { get; set; }
        public DbSet<Order> Orders { get; set; }
        public DbSet<OrderItem> OrderItems { get; set; }
        public DbSet<CartItem> CartItems { get; set; }
        public DbSet<Review> Reviews { get; set; }
        public DbSet<Promotion> Promotions { get; set; }
        public DbSet<PromotionCode> PromotionCodes { get; set; }
        public DbSet<UserMessage> UserMessages { get; set; }
        public DbSet<Notification> Notifications { get; set; }
        
        // New DbSets for enhanced functionality
        public DbSet<SearchHistory> SearchHistories { get; set; }
        public DbSet<UserPreference> UserPreferences { get; set; }
        public DbSet<ProductView> ProductViews { get; set; }
        public DbSet<Return> Returns { get; set; }
        public DbSet<ReturnItem> ReturnItems { get; set; }
        public DbSet<Dispute> Disputes { get; set; }
        public DbSet<DisputeMessage> DisputeMessages { get; set; }
        public DbSet<ShippingDetail> ShippingDetails { get; set; }
        public DbSet<UserToken> UserTokens { get; set; }
        public DbSet<ChatRoom> ChatRooms { get; set; }
        public DbSet<ChatParticipant> ChatParticipants { get; set; }
        public DbSet<ChatMessage> ChatMessages { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            base.OnModelCreating(modelBuilder);

            // User configurations
            modelBuilder.Entity<User>(entity =>
            {
                entity.HasIndex(e => e.Email).IsUnique();
                entity.HasIndex(e => e.Username).IsUnique();
            });

            // Category self-referencing relationship
            modelBuilder.Entity<Category>(entity =>
            {
                entity.HasOne(c => c.ParentCategory)
                      .WithMany(c => c.SubCategories)
                      .HasForeignKey(c => c.ParentCategoryId)
                      .OnDelete(DeleteBehavior.Restrict);
            });

            // Product relationships
            modelBuilder.Entity<Product>(entity =>
            {
                entity.HasOne(p => p.Category)
                      .WithMany(c => c.Products)
                      .HasForeignKey(p => p.CategoryId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(p => p.Brand)
                      .WithMany(b => b.Products)
                      .HasForeignKey(p => p.BrandId)
                      .OnDelete(DeleteBehavior.SetNull);

                entity.HasOne(p => p.Seller)
                      .WithMany(u => u.Products)
                      .HasForeignKey(p => p.SellerId)
                      .OnDelete(DeleteBehavior.Restrict);
            });

            // ProductImage relationship
            modelBuilder.Entity<ProductImage>(entity =>
            {
                entity.HasOne(pi => pi.Product)
                      .WithMany(p => p.Images)
                      .HasForeignKey(pi => pi.ProductId)
                      .OnDelete(DeleteBehavior.Cascade);
            });

            // Order relationships
            modelBuilder.Entity<Order>(entity =>
            {
                entity.HasOne(o => o.Customer)
                      .WithMany(u => u.Orders)
                      .HasForeignKey(o => o.CustomerId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasIndex(e => e.OrderNumber).IsUnique();
            });

            // OrderItem relationships
            modelBuilder.Entity<OrderItem>(entity =>
            {
                entity.HasOne(oi => oi.Order)
                      .WithMany(o => o.OrderItems)
                      .HasForeignKey(oi => oi.OrderId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(oi => oi.Product)
                      .WithMany(p => p.OrderItems)
                      .HasForeignKey(oi => oi.ProductId)
                      .OnDelete(DeleteBehavior.Restrict);
            });

            // CartItem relationships
            modelBuilder.Entity<CartItem>(entity =>
            {
                entity.HasOne(ci => ci.User)
                      .WithMany(u => u.CartItems)
                      .HasForeignKey(ci => ci.UserId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(ci => ci.Product)
                      .WithMany(p => p.CartItems)
                      .HasForeignKey(ci => ci.ProductId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => new { e.UserId, e.ProductId }).IsUnique();
            });

            // Review relationships
            modelBuilder.Entity<Review>(entity =>
            {
                entity.HasOne(r => r.Product)
                      .WithMany(p => p.Reviews)
                      .HasForeignKey(r => r.ProductId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(r => r.User)
                      .WithMany(u => u.Reviews)
                      .HasForeignKey(r => r.UserId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasIndex(e => new { e.ProductId, e.UserId }).IsUnique();
            });

            // PromotionCode relationships
            modelBuilder.Entity<PromotionCode>(entity =>
            {
                entity.HasOne(pc => pc.Promotion)
                      .WithMany(p => p.PromotionCodes)
                      .HasForeignKey(pc => pc.PromotionId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => e.Code).IsUnique();
            });

            // UserMessage relationships
            modelBuilder.Entity<UserMessage>(entity =>
            {
                entity.HasOne(um => um.Sender)
                      .WithMany(u => u.SentMessages)
                      .HasForeignKey(um => um.SenderId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(um => um.Receiver)
                      .WithMany(u => u.ReceivedMessages)
                      .HasForeignKey(um => um.ReceiverId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(um => um.Product)
                      .WithMany()
                      .HasForeignKey(um => um.ProductId)
                      .OnDelete(DeleteBehavior.SetNull);

                entity.HasOne(um => um.Order)
                      .WithMany()
                      .HasForeignKey(um => um.OrderId)
                      .OnDelete(DeleteBehavior.SetNull);
            });

            // Notification relationships
            modelBuilder.Entity<Notification>(entity =>
            {
                entity.HasOne(n => n.User)
                      .WithMany()
                      .HasForeignKey(n => n.UserId)
                      .OnDelete(DeleteBehavior.Cascade);
            });

            // SearchHistory relationships
            modelBuilder.Entity<SearchHistory>(entity =>
            {
                entity.HasOne(sh => sh.User)
                      .WithMany()
                      .HasForeignKey(sh => sh.UserId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => new { e.UserId, e.SearchTerm }).IsUnique();
            });

            // UserPreference relationships
            modelBuilder.Entity<UserPreference>(entity =>
            {
                entity.HasOne(up => up.User)
                      .WithMany()
                      .HasForeignKey(up => up.UserId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(up => up.PreferredCategory)
                      .WithMany()
                      .HasForeignKey(up => up.PreferredCategoryId)
                      .OnDelete(DeleteBehavior.SetNull);

                entity.HasOne(up => up.PreferredBrand)
                      .WithMany()
                      .HasForeignKey(up => up.PreferredBrandId)
                      .OnDelete(DeleteBehavior.SetNull);

                entity.HasIndex(e => e.UserId).IsUnique();
            });

            // ProductView relationships
            modelBuilder.Entity<ProductView>(entity =>
            {
                entity.HasOne(pv => pv.User)
                      .WithMany()
                      .HasForeignKey(pv => pv.UserId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(pv => pv.Product)
                      .WithMany()
                      .HasForeignKey(pv => pv.ProductId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => new { e.UserId, e.ProductId }).IsUnique();
            });

            // Return relationships
            modelBuilder.Entity<Return>(entity =>
            {
                entity.HasOne(r => r.Order)
                      .WithMany()
                      .HasForeignKey(r => r.OrderId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(r => r.Customer)
                      .WithMany()
                      .HasForeignKey(r => r.CustomerId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasIndex(e => e.ReturnNumber).IsUnique();
            });

            // ReturnItem relationships
            modelBuilder.Entity<ReturnItem>(entity =>
            {
                entity.HasOne(ri => ri.Return)
                      .WithMany(r => r.ReturnItems)
                      .HasForeignKey(ri => ri.ReturnId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(ri => ri.Product)
                      .WithMany()
                      .HasForeignKey(ri => ri.ProductId)
                      .OnDelete(DeleteBehavior.Restrict);
            });

            // Dispute relationships
            modelBuilder.Entity<Dispute>(entity =>
            {
                entity.HasOne(d => d.Order)
                      .WithMany()
                      .HasForeignKey(d => d.OrderId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(d => d.Customer)
                      .WithMany()
                      .HasForeignKey(d => d.CustomerId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(d => d.Seller)
                      .WithMany()
                      .HasForeignKey(d => d.SellerId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasOne(d => d.AssignedAdmin)
                      .WithMany()
                      .HasForeignKey(d => d.AssignedAdminId)
                      .OnDelete(DeleteBehavior.SetNull);
            });

            // DisputeMessage relationships
            modelBuilder.Entity<DisputeMessage>(entity =>
            {
                entity.HasOne(dm => dm.Dispute)
                      .WithMany(d => d.DisputeMessages)
                      .HasForeignKey(dm => dm.DisputeId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(dm => dm.Sender)
                      .WithMany()
                      .HasForeignKey(dm => dm.SenderId)
                      .OnDelete(DeleteBehavior.Restrict);
            });

            // ShippingDetail relationships
            modelBuilder.Entity<ShippingDetail>(entity =>
            {
                entity.HasOne(sd => sd.Order)
                      .WithMany()
                      .HasForeignKey(sd => sd.OrderId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => e.OrderId).IsUnique();
                entity.HasIndex(e => e.TrackingNumber);
            });

            // UserToken relationships
            modelBuilder.Entity<UserToken>(entity =>
            {
                entity.HasOne(ut => ut.User)
                      .WithMany()
                      .HasForeignKey(ut => ut.UserId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasIndex(e => e.Token);
            });

            // ChatRoom relationships
            modelBuilder.Entity<ChatRoom>(entity =>
            {
                entity.HasOne(cr => cr.Product)
                      .WithMany()
                      .HasForeignKey(cr => cr.ProductId)
                      .OnDelete(DeleteBehavior.SetNull);

                entity.HasOne(cr => cr.Order)
                      .WithMany()
                      .HasForeignKey(cr => cr.OrderId)
                      .OnDelete(DeleteBehavior.SetNull);
            });

            // ChatParticipant relationships
            modelBuilder.Entity<ChatParticipant>(entity =>
            {
                entity.HasOne(cp => cp.ChatRoom)
                      .WithMany(cr => cr.Participants)
                      .HasForeignKey(cp => cp.ChatRoomId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(cp => cp.User)
                      .WithMany()
                      .HasForeignKey(cp => cp.UserId)
                      .OnDelete(DeleteBehavior.Restrict);

                entity.HasIndex(e => new { e.ChatRoomId, e.UserId }).IsUnique();
            });

            // ChatMessage relationships
            modelBuilder.Entity<ChatMessage>(entity =>
            {
                entity.HasOne(cm => cm.ChatRoom)
                      .WithMany(cr => cr.Messages)
                      .HasForeignKey(cm => cm.ChatRoomId)
                      .OnDelete(DeleteBehavior.Cascade);

                entity.HasOne(cm => cm.Sender)
                      .WithMany()
                      .HasForeignKey(cm => cm.SenderId)
                      .OnDelete(DeleteBehavior.Restrict);
            });
        }
    }
}
