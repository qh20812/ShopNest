using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class Dispute
    {
        [Key]
        public int DisputeId { get; set; }

        [Required]
        public int OrderId { get; set; }

        [Required]
        public int CustomerId { get; set; }

        [Required]
        public int SellerId { get; set; }

        [Required]
        [StringLength(200)]
        public string Subject { get; set; } = string.Empty;

        [Required]
        [StringLength(2000)]
        public string Description { get; set; } = string.Empty;

        [Required]
        public DisputeStatus Status { get; set; } = DisputeStatus.Open;

        [Required]
        public DisputeType Type { get; set; }

        public int? AssignedAdminId { get; set; }

        [StringLength(2000)]
        public string? Resolution { get; set; }

        public DateTime? ResolvedAt { get; set; }

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        public DateTime? UpdatedAt { get; set; }

        // Navigation properties
        [ForeignKey("OrderId")]
        public virtual Order Order { get; set; } = null!;

        [ForeignKey("CustomerId")]
        public virtual User Customer { get; set; } = null!;

        [ForeignKey("SellerId")]
        public virtual User Seller { get; set; } = null!;

        [ForeignKey("AssignedAdminId")]
        public virtual User? AssignedAdmin { get; set; }

        public virtual ICollection<DisputeMessage> DisputeMessages { get; set; } = new List<DisputeMessage>();
    }

    public enum DisputeStatus
    {
        Open = 1,
        InProgress = 2,
        Resolved = 3,
        Closed = 4,
        Escalated = 5
    }

    public enum DisputeType
    {
        ItemNotReceived = 1,
        ItemNotAsDescribed = 2,
        DamagedItem = 3,
        RefundIssue = 4,
        ShippingIssue = 5,
        Other = 6
    }
}
