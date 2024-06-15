<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
</head>
<body>
    <h1>Xác Nhận Đơn Hàng</h1>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin về đơn hàng của bạn:</p>
    <p>Tên khách hàng: {{ $customer->name }}</p>
    <P>Số điện thoại:{{ $customer->phone }}</P>
    <p>Địa chỉ: {{ $customer->address }}</p>
    <p>Email: {{ $customer->email }}</p>
    <p>Bạn hãy truy cập vào tài khoản của mình để kiểm tra lịch xử đơn hàng của mình</p>
</body>
</html>
