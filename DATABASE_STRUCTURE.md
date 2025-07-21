# Cấu trúc Database ShopNest

## Tổng quan
Database ShopNest được thiết kế để hỗ trợ đầy đủ các chức năng của một trang web bán hàng hiện đại, bao gồm:

### 1. Bảng cơ bản (Core Tables)
- **Users**: Quản lý người dùng (Admin, Seller, Customer)
- **Categories**: Danh mục sản phẩm (hỗ trợ danh mục con)
- **Brands**: Thương hiệu sản phẩm
- **Products**: Sản phẩm với đầy đủ thông tin
- **ProductImages**: Hình ảnh sản phẩm

### 2. Bảng quản lý đơn hàng (Order Management)
- **Orders**: Đơn hàng với đầy đủ thông tin thanh toán và giao hàng
- **OrderItems**: Chi tiết sản phẩm trong đơn hàng
- **CartItems**: Giỏ hàng của người dùng

### 3. Bảng khuyến mãi (Promotion System)
- **Promotions**: Chương trình khuyến mãi
- **PromotionCodes**: Mã giảm giá

### 4. Bảng đánh giá và phản hồi (Reviews & Feedback)
- **Reviews**: Đánh giá sản phẩm
- **UserMessages**: Tin nhắn giữa người dùng

### 5. Bảng thông báo (Notifications)
- **Notifications**: Thông báo cho người dùng

### 6. Bảng hỗ trợ tìm kiếm và đề xuất (Search & Recommendations)
- **SearchHistories**: Lịch sử tìm kiếm
- **UserPreferences**: Sở thích người dùng
- **ProductViews**: Lịch sử xem sản phẩm

### 7. Bảng quản lý đổi trả (Returns Management)
- **Returns**: Yêu cầu đổi trả
- **ReturnItems**: Chi tiết sản phẩm đổi trả

### 8. Bảng xử lý tranh chấp (Dispute Resolution)
- **Disputes**: Tranh chấp đơn hàng
- **DisputeMessages**: Tin nhắn trong tranh chấp

### 9. Bảng tích hợp giao hàng (Shipping Integration)
- **ShippingDetails**: Chi tiết giao hàng từ API bên thứ ba

### 10. Bảng bảo mật (Security)
- **UserTokens**: Quản lý JWT tokens và sessions

### 11. Bảng chat trực tuyến (Real-time Chat)
- **ChatRooms**: Phòng chat
- **ChatParticipants**: Thành viên trong phòng chat
- **ChatMessages**: Tin nhắn chat

## Mức độ hỗ trợ chức năng

### ✅ Đầy đủ hỗ trợ:
1. **Khách hàng**:
   - Duyệt sản phẩm (lọc, sắp xếp)
   - Tìm kiếm và đề xuất sản phẩm
   - Giỏ hàng
   - Thanh toán
   - Quản lý tài khoản
   - Đánh giá và phản hồi
   - Khuyến mãi

2. **Người bán**:
   - Quản lý sản phẩm
   - Quản lý đơn hàng
   - Thống kê doanh thu
   - Hỗ trợ khách hàng (bao gồm đổi trả)

3. **Quản trị viên**:
   - Quản lý người dùng
   - Quản lý sản phẩm và danh mục
   - Quản lý đơn hàng và tranh chấp
   - Quản lý khuyến mãi
   - Thống kê và báo cáo

4. **Chức năng bổ sung**:
   - Chat trực tuyến
   - Thông báo
   - Tích hợp API thanh toán và giao hàng
   - Bảo mật với token management

## Các quan hệ chính:
- **1-N**: User → Products (Seller), User → Orders, Order → OrderItems
- **N-N**: User ↔ Products (qua CartItems, ProductViews)
- **Self-referencing**: Categories (Parent-Child)
- **Soft Delete**: Sử dụng IsActive fields
- **Audit Trail**: CreatedAt, UpdatedAt fields

## Tính năng nâng cao:
- **Search & Recommendations**: Hỗ trợ AI/ML cho đề xuất sản phẩm
- **Real-time Chat**: Sẵn sàng cho SignalR
- **Third-party Integration**: Chuẩn bị cho APIs thanh toán và giao hàng
- **Security**: JWT token management với device tracking
- **Audit & Analytics**: Tracking user behavior và system metrics

Database này đã sẵn sàng để triển khai một trang web bán hàng hoàn chỉnh với tất cả các tính năng hiện đại.
