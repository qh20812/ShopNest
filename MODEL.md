# DANH SÁCH MODEL CỦA DỰ ÁN
---
Dự án hiện có tổng cộng 56 model.
---

## 1. User
```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'first_name',
        'last_name',
        'phone_number',
        'is_active',
        'default_address_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function defaultAddress()
    {
        return $this->belongsTo(UserAddress::class, 'default_address_id');
    }
}
```
## UserAddress
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'street_address',
        'is_default',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'ward_id');
    }
}

```
## 3. UserEvent
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'event_type',
        'event_category',
        'event_data',
        'ip_address',
        'user_agent',
        'referrer',
        'url',
    ];

    protected $casts = [
        'event_data' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```
## 4. AdministrativeDivision
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeDivision extends Model
{
    protected $fillable = [
        'country_id',
        'parent_id',
        'name',
        'level',
        'code',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
```

## 5. AnalyticsReport
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsReport extends Model
{
    protected $fillable = [
        'title',
        'type',
        'period_type',
        'start_date',
        'end_date',
        'parameters',
        'result_data',
        'file_path',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'parameters' => 'array',
        'result_data' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
```

## 6. Attribute
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 7. AttributeValue
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $primaryKey = 'attribute_value_id';

    protected $fillable = [
        'attribute_id',
        'value',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
```

## 8. AttributeValueProductVariant
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueProductVariant extends Model
{
    protected $table = 'attribute_value_product_variant';

    protected $fillable = [
        'product_variant_id',
        'attribute_value_id',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
}
```

## 9. AuditLog
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'ip_address',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 10. Brand
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 11. CartItem
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $primaryKey = 'cart_item_id';

    protected $fillable = [
        'user_id',
        'variant_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
```

## 12. Category
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'parent_category_id',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_category_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_category_id');
    }
}
```

## 13. ChatMessage
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $primaryKey = 'chat_message_id';

    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'content',
        'content_type',
        'attachment_url',
        'is_edited',
        'edited_at',
    ];

    protected $casts = [
        'content_type' => 'integer',
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
```
## 14. ChatParticipant
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatParticipant extends Model
{
    protected $primaryKey = 'chat_participant_id';

    protected $fillable = [
        'chat_room_id',
        'user_id',
        'joined_at',
        'left_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 15. ChatRoom
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $primaryKey = 'chat_room_id';

    protected $fillable = [
        'room_name',
        'type',
        'is_active',
    ];

    protected $casts = [
        'type' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 16. CouponUsage
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    protected $fillable = [
        'promotion_code_id',
        'user_id',
        'order_id',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function promotionCode()
    {
        return $this->belongsTo(PromotionCode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
```

## 17. Country
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'iso_code_2',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 18. Currency
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'exchange_rate',
        'is_active',
    ];

    protected $casts = [
        'exchange_rate' => 'float',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 19. Dispute
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $primaryKey = 'dispute_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'seller_id',
        'subject',
        'description',
        'status',
        'type',
        'assigned_admin_id',
        'resolution',
        'resolved_at',
    ];

    protected $casts = [
        'type' => 'integer',
        'resolved_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_admin_id');
    }
}
```

## 20. DisputeMessage
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisputeMessage extends Model
{
    protected $primaryKey = 'dispute_message_id';

    protected $fillable = [
        'dispute_id',
        'sender_id',
        'content',
        'attachment_url',
        'is_admin_message',
    ];

    protected $casts = [
        'is_admin_message' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function dispute()
    {
        return $this->belongsTo(Dispute::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
```

## 21. FlashSaleEvent
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleEvent extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'status',
        'description',
        'banner_image',
        'metadata',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 22. FlashSaleProduct
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    protected $fillable = [
        'flash_sale_event_id',
        'product_variant_id',
        'flash_sale_price',
        'quantity_limit',
        'sold_count',
        'discount_percentage',
        'max_quantity_per_user',
        'metadata',
    ];

    protected $casts = [
        'flash_sale_price' => 'float',
        'quantity_limit' => 'integer',
        'sold_count' => 'integer',
        'discount_percentage' => 'float',
        'max_quantity_per_user' => 'integer',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function flashSaleEvent()
    {
        return $this->belongsTo(FlashSaleEvent::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
```

## 23. Hub
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    protected $fillable = [
        'name',
        'address',
        'ward_id',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function ward()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'ward_id');
    }
}
```
## 24. InventoryLog
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = [
        'variant_id',
        'quantity_change',
        'reason',
        'order_id',
        'user_id',
    ];

    protected $casts = [
        'quantity_change' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 25. InternationalAddress
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalAddress extends Model
{
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'type',
        'first_name',
        'last_name',
        'company',
        'phone',
        'email',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'locality',
        'administrative_area',
        'sub_administrative_area',
        'postal_code',
        'country_code',
        'country_name',
        'latitude',
        'longitude',
        'validation_result',
        'formatted_address',
        'is_verified',
        'is_default',
        'timezone',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'validation_result' => 'array',
        'metadata' => 'array',
        'is_verified' => 'boolean',
        'is_default' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 26. Order
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'order_number',
        'sub_total',
        'shipping_fee',
        'discount_amount',
        'total_amount',
        'status',
        'currency',
        'exchange_rate',
        'total_amount_base',
        'payment_method',
        'payment_status',
        'payment_transaction_id',
        'shipping_address_id',
        'notes',
        'shipped_at',
        'delivered_at',
        'shipper_id',
        'base_currency',
    ];

    protected $casts = [
        'sub_total' => 'float',
        'shipping_fee' => 'float',
        'discount_amount' => 'float',
        'total_amount' => 'float',
        'exchange_rate' => 'float',
        'total_amount_base' => 'float',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 27. OrderItem
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'order_item_id';

    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
        'total_price' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
```

## 28. OrderPromotion
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPromotion extends Model
{
    protected $table = 'order_promotion';

    protected $fillable = [
        'order_id',
        'promotion_id',
        'discount_applied',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $casts = [
        'discount_applied' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
```

## 29. Permission
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 30. PermissionRole
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
```

## 31. Product
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'category_id',
        'brand_id',
        'seller_id',
        'status',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 32. ProductAnswer
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'user_id',
        'answer',
        'user_type',
        'is_verified',
        'is_anonymous',
        'helpful_count',
        'not_helpful_count',
        'is_best_answer',
        'metadata',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_anonymous' => 'boolean',
        'is_best_answer' => 'boolean',
        'helpful_count' => 'integer',
        'not_helpful_count' => 'integer',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function question()
    {
        return $this->belongsTo(ProductQuestion::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 33. ProductImage
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'product_id',
        'image_url',
        'alt_text',
        'is_primary',
        'display_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'display_order' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```
## 34. ProductQuestion
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'question',
        'status',
        'is_anonymous',
        'helpful_count',
        'answers_count',
        'is_featured',
        'metadata',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_featured' => 'boolean',
        'helpful_count' => 'integer',
        'answers_count' => 'integer',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 35. ProductTag
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $table = 'product_tags';

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
```

## 36. ProductVariant
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'variant_id';

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'discount_price',
        'stock_quantity',
        'reserved_quantity',
        'available_quantity',
        'minimum_stock_level',
        'track_inventory',
        'allow_backorder',
        'last_restocked_at',
        'image_id',
    ];

    protected $casts = [
        'price' => 'float',
        'discount_price' => 'float',
        'stock_quantity' => 'integer',
        'reserved_quantity' => 'integer',
        'available_quantity' => 'integer',
        'minimum_stock_level' => 'integer',
        'track_inventory' => 'boolean',
        'allow_backorder' => 'boolean',
        'last_restocked_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function image()
    {
        return $this->belongsTo(ProductImage::class, 'image_id');
    }
}
```

## 37. ProductView
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    protected $primaryKey = 'product_view_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'view_count',
        'last_viewed',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'last_viewed' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```

## 38. Promotion
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $primaryKey = 'promotion_id';

    protected $fillable = [
        'name',
        'description',
        'type',
        'value',
        'min_order_amount',
        'max_discount_amount',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'is_active',
        'priority',
        'stackable',
        'customer_eligibility',
        'geographic_restrictions',
        'product_restrictions',
        'budget_limit',
        'budget_used',
        'daily_usage_limit',
        'daily_usage_count',
        'per_customer_limit',
        'first_time_customer_only',
        'minimum_cart_value',
        'maximum_discount_amount',
        'time_restrictions',
        'auto_apply_condition',
        'terms_and_conditions',
        'last_used_at',
    ];

    protected $casts = [
        'type' => 'integer',
        'value' => 'float',
        'min_order_amount' => 'float',
        'max_discount_amount' => 'float',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
        'priority' => 'integer',
        'stackable' => 'boolean',
        'budget_limit' => 'float',
        'budget_used' => 'float',
        'daily_usage_limit' => 'integer',
        'daily_usage_count' => 'integer',
        'per_customer_limit' => 'integer',
        'first_time_customer_only' => 'boolean',
        'minimum_cart_value' => 'float',
        'maximum_discount_amount' => 'float',
        'last_used_at' => 'datetime',
        'customer_eligibility' => 'array',
        'geographic_restrictions' => 'array',
        'product_restrictions' => 'array',
        'time_restrictions' => 'array',
        'auto_apply_condition' => 'array',
        'terms_and_conditions' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 39. PromotionCode
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    protected $primaryKey = 'promotion_code_id';

    protected $fillable = [
        'promotion_id',
        'code',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
```

## 40. Review
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 41. ReviewMedia
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewMedia extends Model
{
    protected $fillable = [
        'review_id',
        'media_type',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'metadata',
        'display_order',
        'is_primary',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'metadata' => 'array',
        'display_order' => 'integer',
        'is_primary' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
```

## 42. Returns
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
class Returns extends Model
{
    protected $primaryKey = 'return_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'return_number',
        'reason',
        'description',
        'status',
        'refund_amount',
        'type',
        'admin_note',
        'processed_at',
        'refunded_at',
    ];

    protected $casts = [
        'reason' => 'integer',
        'refund_amount' => 'float',
        'type' => 'integer',
        'processed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
```

## 43. ReturnItem
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $primaryKey = 'return_item_id';

    protected $fillable = [
        'return_id',
        'variant_id',
        'quantity',
        'unit_price',
        'total_price',
        'reason',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
        'total_price' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function return()
    {
        return $this->belongsTo(Returns::class, 'return_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
```
## 44. Role
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 45. RoleUser
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
```

## 46. SearchHistory
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = [
        'user_id',
        'search_term',
        'search_count',
        'last_searched',
    ];

    protected $casts = [
        'search_count' => 'integer',
        'last_searched' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 47. ShipmentJourney
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentJourney extends Model
{
    protected $fillable = [
        'order_id',
        'leg_type',
        'shipper_id',
        'start_hub_id',
        'end_hub_id',
        'status',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function startHub()
    {
        return $this->belongsTo(Hub::class, 'start_hub_id');
    }

    public function endHub()
    {
        return $this->belongsTo(Hub::class, 'end_hub_id');
    }
}
```

## 48. ShipperProfile
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperProfile extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'id_card_number',
        'id_card_front_url',
        'id_card_back_url',
        'driver_license_number',
        'driver_license_front_url',
        'vehicle_type',
        'license_plate',
        'status',
        'operating_area',
    ];

    protected $casts = [
        'operating_area' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 49. ShipperRating
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperRating extends Model
{
    protected $fillable = [
        'order_id',
        'shipper_id',
        'customer_id',
        'rating',
        'comment',
        'criteria_ratings',
        'is_anonymous',
        'rated_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'criteria_ratings' => 'array',
        'is_anonymous' => 'boolean',
        'rated_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
```

## 50. Shop
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'phone',
        'email',
        'website',
        'business_type',
        'tax_id',
        'business_license',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'status',
        'is_verified',
        'commission_rate',
        'shipping_policies',
        'return_policy',
        'social_media',
        'rating',
        'total_reviews',
        'total_sales',
        'total_revenue',
        'meta_title',
        'meta_description',
        'keywords',
        'verified_at',
        'last_active_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'commission_rate' => 'float',
        'shipping_policies' => 'array',
        'return_policy' => 'array',
        'social_media' => 'array',
        'rating' => 'float',
        'total_reviews' => 'integer',
        'total_sales' => 'integer',
        'total_revenue' => 'float',
        'verified_at' => 'datetime',
        'last_active_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 51. Tag
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
```

## 52. Transaction
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'type',
        'amount',
        'currency',
        'gateway',
        'gateway_transaction_id',
        'status',
        'refund_reason',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'float',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
```

## 53. UserPreference
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'preferred_category_id',
        'preferred_brand_id',
        'min_price_range',
        'max_price_range',
    ];

    protected $casts = [
        'min_price_range' => 'float',
        'max_price_range' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preferredCategory()
    {
        return $this->belongsTo(Category::class, 'preferred_category_id');
    }

    public function preferredBrand()
    {
        return $this->belongsTo(Brand::class, 'preferred_brand_id');
    }
}
```

## 54. Wishlist
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'privacy',
        'is_default',
        'items_count',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'items_count' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

## 55. WishlistItem
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    protected $fillable = [
        'wishlist_id',
        'product_id',
        'product_variant',
        'price_when_added',
        'note',
        'priority',
        'notify_price_drop',
        'notify_back_in_stock',
        'notified_at',
    ];

    protected $casts = [
        'product_variant' => 'array',
        'price_when_added' => 'float',
        'priority' => 'integer',
        'notify_price_drop' => 'boolean',
        'notify_back_in_stock' => 'boolean',
        'notified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```
## 56. ShippingDetail
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $primaryKey = 'shipping_detail_id';

    protected $fillable = [
        'order_id',
        'shipping_provider',
        'tracking_number',
        'external_order_id',
        'status',
        'shipping_fee',
        'status_history',
    ];

    protected $casts = [
        'status' => 'integer',
        'shipping_fee' => 'float',
        'status_history' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
```
## 57. Notification
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
        'is_read',
        'notifiable_id',
        'notifiable_type',
        'action_url',
        'read_at',
    ];

    protected $casts = [
        'type' => 'integer',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
```
## 58. Subscription
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SubscriptionStatus;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'paypal_id',
        'gateway',
        'amount',
        'currency',
        'status',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'canceled_at',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'float',
        'metadata' => 'array',
        'trial_ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'canceled_at' => 'datetime',
        'status' => SubscriptionStatus::class,
    ];

    protected $dates = [
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'canceled_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```