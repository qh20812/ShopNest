using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ShopNest.Models
{
    public class ChatMessage
    {
        [Key]
        public int ChatMessageId { get; set; }

        [Required]
        public int ChatRoomId { get; set; }

        [Required]
        public int SenderId { get; set; }

        [Required]
        [StringLength(2000)]
        public string Content { get; set; } = string.Empty;

        public MessageContentType ContentType { get; set; } = MessageContentType.Text;

        [StringLength(500)]
        public string? AttachmentUrl { get; set; }

        public bool IsRead { get; set; } = false;

        public bool IsEdited { get; set; } = false;

        public DateTime? EditedAt { get; set; }

        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        // Navigation properties
        [ForeignKey("ChatRoomId")]
        public virtual ChatRoom ChatRoom { get; set; } = null!;

        [ForeignKey("SenderId")]
        public virtual User Sender { get; set; } = null!;
    }

    public enum MessageContentType
    {
        Text = 1,
        Image = 2,
        File = 3,
        System = 4
    }
}
