<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
</head>
<body>
    @php
        $paymentMethods = [
            'cash_on_delivery' => 'Thanh toán khi nhận hàng',
            'payment_at_store' => 'Thanh toán tại cửa hàng',
            'vnpay' => 'Thanh toán bằng VNPAY',
        ];
    @endphp
    <h1>Xác Nhận Đơn Hàng</h1>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin về đơn hàng của bạn:</p>
    <p>Tên khách hàng: {{ $customer->name }}</p>
    <p>Số điện thoại: {{ $customer->phone }}</p>
    <p>Địa chỉ: {{ $customer->address }}</p>
    <p>Email: {{ $customer->email }}</p>
    <p>Phương thức thanh toán: {{ $paymentMethods[$customer->payment_method] ?? 'N/A' }}</p>
    <p>Bạn hãy truy cập vào tài khoản của mình để kiểm tra lịch sử đơn hàng của mình.</p>

    <div class="contact-info">
        <div>
            <p style="font-size: 14px; font-weight: bold;">THÔNG TIN LIÊN HỆ</p>
            <p>185 Minh Khai, Hoàng Mai, Hà Nội</p>
            <p>Email: tranlam2782002@gmail.com</p>
            <p>Điện thoại: (+84) 326 450 840</p>
            <p>Giờ mở cửa: 7:00 sáng - 22:00 tối</p>
        </div>
    </div>
</body>
</html>
