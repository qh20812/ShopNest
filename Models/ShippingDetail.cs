using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class ShippingDetail
    {
        [Key]
        public int ShippingDetailId { get; set; }

        [Required]
        public int OrderId { get; set; }

        [Required]
        [StringLength(100)]
        public string ShippingProvider { get; set; } = string.Empty; // GHN, GHTK, etc.

        [StringLength(100)]
        public string? TrackingNumber { get; set; }

        [StringLength(100)]
        public string? ExternalOrderId { get; set; } // ID từ API giao hàng

        [Required]
        public ShippingStatus Status { get; set; } = ShippingStatus.Pending;

        [Column(TypeName = "decimal(18,2)")]
        public decimal ShippingFee { get; set; }

        [Column(TypeName = "decimal(18,2)")]
        public decimal? ActualWeight { get; set; }

        [StringLength(500)]
        public string? PickupAddress { get; set; }

        [StringLength(500)]
        public string? DeliveryAddress { get; set; }

        public DateTime? PickupTime { get; set; }

        public DateTime? EstimatedDeliveryTime { get; set; }

        public DateTime? ActualDeliveryTime { get; set; }

        [StringLength(1000)]
        public string? Notes { get; set; }

        [StringLength(2000)]
        public string? StatusHistory { get; set; } // JSON lưu lịch sử trạng thái

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        public DateTime? UpdatedAt { get; set; }

        // Navigation properties
        [ForeignKey("OrderId")]
        public virtual Order Order { get; set; } = null!;
    }

    public enum ShippingStatus
    {
        Pending = 1,
        PickupScheduled = 2,
        PickedUp = 3,
        InTransit = 4,
        OutForDelivery = 5,
        Delivered = 6,
        DeliveryFailed = 7,
        Returned = 8,
        Cancelled = 9
    }
}
