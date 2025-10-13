# DANH SÁCH CÁC ENUM TRONG DỰ ÁN
---
## 1. SubscriptionStatus
```php
<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'active';
    case CANCELLED = 'cancelled';
    case PAST_DUE = 'past_due';
}
```
## 2. AnalyticsReportsPeriodType
```php
<?php
namespace App\Enums;
enum AnalyticsReportsPeriodType: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
    case CUSTOM = 'custom';
}
```
## 3. AnalyticsReportsStatus
```php
<?php
namespace App\Enums;
enum AnalyticsReportsStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
```
## 4. AnalyticsReportsType
```php
<?php
namespace App\Enums;
enum AnalyticsReportsType: string
{
    case REVENUE = 'revenue';
    case ORDERS = 'orders';
    case PRODUCTS = 'products';
    case USERS = 'users';
    case CUSTOM = 'custom';
}
```
## 5. DisputesStatus
```php
<?php
namespace App\Enums;
enum DisputesStatus: string
{
    case OPEN = 'open';
    case UNDER_REVIEW = 'under_review';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
}
```
## 6. FlashSaleEventsStatus
```php
<?php
namespace App\Enums;
enum FlashSaleEventsStatus: string
{
    case SCHEDULED = 'scheduled';
    case ACTIVE = 'active';
    case ENDED = 'ended';
    case CANCELLED = 'cancelled';
}
```
## 7. NotificationType
```php
<?php
namespace App\Enums;
enum NotificationType: string
{
    case ORDER = 'order';
    case PROMOTION = 'promotion';
    case SHIPPING = 'shipping';
    case ACCOUNT = 'account';
}
```
## 8. OrdersPaymentStatus
```php
<?php
namespace App\Enums;
enum OrdersPaymentStatus: string
{
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
```
## 9. OrdersStatus
```php
<?php
namespace App\Enums;
enum OrdersStatus: string
{
    case PENDING_CONFIRMATION = 'pending_confirmation';
    case PROCESSING = 'processing';
    case PENDING_ASSIGNMENT = 'pending_assignment';
    case ASSIGNED_TO_SHIPPER = 'assigned_to_shipper';
    case DELIVERING = 'delivering';
    case DELIVERED = 'delivered';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case RETURNED = 'returned';
}
```
## 10. ProductAnswersUserType
```php
<?php
namespace App\Enums;
enum ProductAnswersUserType: string
{
    case CUSTOMER = 'customer';
    case SELLER = 'seller';
    case ADMIN = 'admin';
}
```
## 11. ProductQuestionsStatus
```php
<?php
namespace App\Enums;
enum ProductQuestionsStatus: string
{
    case PENDING = 'pending';
    case ANSWERED = 'answered';
    case REJECTED = 'rejected';
}
```
## 12. ProductsStatus
```php
<?php
namespace App\Enums;
enum ProductsStatus: string
{
    case DRAFT = 'draft';
    case PENDING_APPROVAL = 'pending_approval';
    case PUBLISHED = 'published';
    case HIDDEN = 'hidden';
}
```
## 13. PromotionsPriority
```php
<?php
namespace App\Enums;
enum PromotionsPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';
}
```
## 14. PromotionStatus
```php
<?php
namespace App\Enums;
enum PromotionStatus: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case UPCOMING = 'upcoming';
    case CANCELLED = 'cancelled';
}
```
## 15. ReturnsStatus
```php
<?php
namespace App\Enums;
enum ReturnsStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case REFUNDED = 'refunded';
    case EXCHANGED = 'exchanged';
    case CANCELLED = 'cancelled';
}
```
## 16. ReviewMediaMediaType
```php
<?php
namespace App\Enums;
enum ReviewMediaMediaType: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';
}
```
## 17. ReviewStatus
```php
<?php
namespace App\Enums;
enum ReviewStatus: string
{
    case PENDING_APPROVAL = 'pending_approval';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
```
## 18. ShipmentJourneysLegType
```php
<?php
namespace App\Enums;
enum ShipmentJourneysLegType: string
{
    case FIRST_MILE = 'first_mile';
    case MIDDLE_MILE = 'middle_mile';
    case LAST_MILE = 'last_mile';
}
```
## 19. ShipperProfilesStatus
```php
<?php
namespace App\Enums;
enum ShipperProfilesStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case SUSPENDED = 'suspended';
}
```
## 20. ShopsStatus
```php
<?php
namespace App\Enums;
enum ShopsStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case INACTIVE = 'inactive';
}
```
## 21. TransactionsType
```php
<?php
namespace App\Enums;
enum TransactionsType: string
{
    case PAYMENT = 'payment';
    case REFUND = 'refund';
}
```
## 22. UserEventsEventType
```php
<?php
namespace App\Enums;
enum UserEventsEventType: string
{
    case PAGE_VIEW = 'page_view';
    case PRODUCT_VIEW = 'product_view';
    case ADD_TO_CART = 'add_to_cart';
    case REMOVE_FROM_CART = 'remove_from_cart';
    case CHECKOUT_START = 'checkout_start';
    case CHECKOUT_COMPLETE = 'checkout_complete';
    case PURCHASE = 'purchase';
    case LOGIN = 'login';
    case REGISTER = 'register';
    case LOGOUT = 'logout';
    case SEARCH = 'search';
    case FILTER = 'filter';
    case WISHLIST_ADD = 'wishlist_add';
}
```
## 23. WishlistsPrivacy
```php
<?php
namespace App\Enums;
enum WishlistsPrivacy: string
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';
    case SHARED = 'shared';
}
```
## 24. ChatMessageContentType
```php
<?php
namespace App\Enums;
enum ChatMessageContentType: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case FILE = 'file';
}
```
## 25. DisputeType
```php
<?php
namespace App\Enums;
enum DisputeType: string
{
    case ITEM_NOT_RECEIVED = 'item_not_received';
    case ITEM_NOT_AS_DESCRIBED = 'item_not_as_described';
    case OTHER = 'other';
}
```
## 26. InternationalAddressesType
```php
<?php
namespace App\Enums;
enum InternationalAddressesType: string
{
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
    case PICKUP = 'pickup';
    case DEFAULT = 'default';
}
```
## 27. PaymentMethodType
```php
<?php
namespace App\Enums;
enum PaymentMethodType: string
{
    case COD = 'cod';
    case BANK_TRANSFER = 'bank_transfer';
    case ONLINE_GATEWAY = 'online_gateway';
}
```
## 28. PromotionType
```php
<?php
namespace App\Enums;
enum PromotionType: string
{
    case PERCENTAGE = 'percentage';
    case FIXED_AMOUNT = 'fixed_amount';
}
```
## 29. ReturnReason
```php
<?php
namespace App\Enums;
enum ReturnReason: string
{
    case DEFECTIVE_PRODUCT = 'defective_product';
    case WRONG_PRODUCT = 'wrong_product';
    case SIZE_ISSUE = 'size_issue';
    case OTHER = 'other';
}
```
## 30. ReturnType
```php
<?php
namespace App\Enums;
enum ReturnType: string
{
    case REFUND = 'refund';
    case EXCHANGE = 'exchange';
}
```
## 31. ShippingDetailStatus
```php
<?php
namespace App\Enums;
enum ShippingDetailStatus: string
{
    case PENDING = 'pending';
    case SHIPPED = 'shipped';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
}
```
## 32. ChatRoomType
```php
<?php
namespace App\Enums;
enum ChatRoomType: string
{
    case USER_TO_USER = 'user_to_user';
    case USER_TO_SELLER = 'user_to_seller';
}
```
## 33. GatewayType
```php
<?php
namespace App\Enums;
enum GatewayType: string
{
    case COD = 'cod';
    case STRIPE = 'stripe';
    case MOMO = 'momo';
    case VNPAY = 'vnpay';
    case PAYPAL = 'paypal';
}
```
## 34. TransactionStatus
```php
<?php
namespace App\Enums;
enum TransactionStatus: string
{
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case PENDING = 'pending';
}
```
## 35. AuditLogAction
```php
<?php
namespace App\Enums;
enum AuditLogAction: string
{
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case UPDATE_PRODUCT = 'update_product';
    case CREATE_ORDER = 'create_order';
    case REFUND = 'refund';
    case OTHER = 'other';
}
```
## 36. InventoryLogReason
```php
<?php
namespace App\Enums;
enum InventoryLogReason: string
{
    case SALE = 'sale';
    case RETURN = 'return';
    case RESTOCK = 'restock';
    case ADJUSTMENT = 'adjustment';
}
```
## 37. UserStatus
```php
<?php
namespace App\Enums;
enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
}
```