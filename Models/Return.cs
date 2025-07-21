using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class Return
    {
        [Key]
        public int ReturnId { get; set; }

        [Required]
        public int OrderId { get; set; }

        [Required]
        public int CustomerId { get; set; }

        [Required]
        [StringLength(50)]
        public string ReturnNumber { get; set; } = string.Empty;

        [Required]
        public ReturnReason Reason { get; set; }

        [Required]
        [StringLength(1000)]
        public string Description { get; set; } = string.Empty;

        [Required]
        public ReturnStatus Status { get; set; } = ReturnStatus.Pending;

        [Column(TypeName = "decimal(18,2)")]
        public decimal RefundAmount { get; set; }

        public ReturnType Type { get; set; } = ReturnType.Refund;

        [StringLength(500)]
        public string? AdminNotes { get; set; }

        public DateTime? ProcessedAt { get; set; }

        public DateTime? RefundedAt { get; set; }

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        public DateTime? UpdatedAt { get; set; }

        // Navigation properties
        [ForeignKey("OrderId")]
        public virtual Order Order { get; set; } = null!;

        [ForeignKey("CustomerId")]
        public virtual User Customer { get; set; } = null!;

        public virtual ICollection<ReturnItem> ReturnItems { get; set; } = new List<ReturnItem>();
    }

    public enum ReturnReason
    {
        Defective = 1,
        WrongItem = 2,
        NotAsDescribed = 3,
        DamagedShipping = 4,
        ChangeOfMind = 5,
        Other = 6
    }

    public enum ReturnStatus
    {
        Pending = 1,
        Approved = 2,
        Rejected = 3,
        Processing = 4,
        Completed = 5,
        Cancelled = 6
    }

    public enum ReturnType
    {
        Refund = 1,
        Exchange = 2,
        StoreCredit = 3
    }
}
