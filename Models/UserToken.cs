using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class UserToken
    {
        [Key]
        public int TokenId { get; set; }

        [Required]
        public int UserId { get; set; }

        [Required]
        [StringLength(500)]
        public string Token { get; set; } = string.Empty;

        [Required]
        public TokenType Type { get; set; }

        [StringLength(100)]
        public string? DeviceInfo { get; set; }

        [StringLength(45)]
        public string? IpAddress { get; set; }

        public bool IsRevoked { get; set; } = false;

        public DateTime ExpiresAt { get; set; }

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        public DateTime? RevokedAt { get; set; }

        // Navigation properties
        [ForeignKey("UserId")]
        public virtual User User { get; set; } = null!;
    }

    public enum TokenType
    {
        AccessToken = 1,
        RefreshToken = 2,
        PasswordReset = 3,
        EmailVerification = 4
    }
}
