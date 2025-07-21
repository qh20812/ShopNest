using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class DisputeMessage
    {
        [Key]
        public int DisputeMessageId { get; set; }

        [Required]
        public int DisputeId { get; set; }

        [Required]
        public int SenderId { get; set; }

        [Required]
        [StringLength(2000)]
        public string Content { get; set; } = string.Empty;

        [StringLength(500)]
        public string? AttachmentUrl { get; set; }

        public bool IsAdminMessage { get; set; } = false;

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        // Navigation properties
        [ForeignKey("DisputeId")]
        public virtual Dispute Dispute { get; set; } = null!;

        [ForeignKey("SenderId")]
        public virtual User Sender { get; set; } = null!;
    }
}
