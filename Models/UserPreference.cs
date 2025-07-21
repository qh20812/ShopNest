using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class UserPreference
    {
        [Key]
        public int UserPreferenceId { get; set; }

        [Required]
        public int UserId { get; set; }

        public int? PreferredCategoryId { get; set; }

        public int? PreferredBrandId { get; set; }

        [Column(TypeName = "decimal(18,2)")]
        public decimal? MinPriceRange { get; set; }

        [Column(TypeName = "decimal(18,2)")]
        public decimal? MaxPriceRange { get; set; }

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        public DateTime? UpdatedAt { get; set; }

        // Navigation properties
        [ForeignKey("UserId")]
        public virtual User User { get; set; } = null!;

        [ForeignKey("PreferredCategoryId")]
        public virtual Category? PreferredCategory { get; set; }

        [ForeignKey("PreferredBrandId")]
        public virtual Brand? PreferredBrand { get; set; }
    }
}
