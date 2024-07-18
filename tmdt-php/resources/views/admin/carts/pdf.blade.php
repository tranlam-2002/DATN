<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuất Đơn Hàng</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('https://cdnjs.cloudflare.com/ajax/libs/dejavu-fonts/2.37/ttf/DejaVuSans.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            font-size: 14px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-info p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: red;
        }
        .order-id {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-id p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .customer ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .customer ul li {
            margin-bottom: 8px;
        }
        .customer ul li strong {
            font-weight: 700;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .mt-3 {
            margin-top: 20px;
        }
        .shipping {
            margin-top: 10px;
        }
        .shipping strong {
            color: red;
        }
        .contact-info {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .contact-info p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="company-info">
            <p>Công ty chịu trách nhiệm: Lam Store - Cửa hàng bán đồ điện tử thông minh</p>
        </div>

        <div class="order-id">
            <p>Mã Đơn Hàng: <strong>{{ $customer->id }}</strong></p>
        </div>

        <div class="customer">
            @php
                $statusTexts = [
                    'pending' => 'Chờ duyệt',
                    'approved' => 'Đã duyệt',
                    'shipped' => 'Đã giao',
                ];
                $paymentMethods = [
                    'cash_on_delivery' => 'Thanh toán khi nhận hàng',
                    'payment_at_store' => 'Thanh toán tại cửa hàng',
                    'vnpay' => 'Thanh toán bằng VNPAY',
                ];
            @endphp
            <ul>
                <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
                <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
                <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
                <li>Email: <strong>{{ $customer->email }}</strong></li>
                <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
                <li>Phương thức thanh toán: <strong>{{ $paymentMethods[$customer->payment_method] ?? 'N/A' }}</strong></li>
                <li>Trạng thái:
                    <strong style="color: rgb(10, 146, 236)">
                        @if($customer->delivered)
                            Giao hàng thành công
                        @else
                            {{ ucfirst($statusTexts[$customer->status]) }}
                        @endif
                    </strong>
                </li>
            </ul>
        </div>

        <div class="carts">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $key => $cart)
                        @php
                            $price = $cart->price * $cart->pty;
                            $total += $price;
                        @endphp
                        <tr>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ number_format($cart->price, 0, '', '.') }}₫</td>
                            <td>{{ $cart->pty }}</td>
                            <td>{{ number_format($price, 0, '', '.') }}₫</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right"><strong>Tổng Tiền</strong></td>
                        <td><strong>{{ number_format($total, 0, '', '.') }}₫</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="shipping">
            Đơn vị giao hàng: <strong>VIETTEL POST</strong>
        </div>
        
        <div class="contact-info">
            <div>
                <p style="font-size: 14px; font-weight: bold;">THÔNG TIN LIÊN HỆ</p>
                <p>185 Minh Khai, Hoàng Mai, Hà Nội</p>
                <p>Email: tranlam2782002@gmail.com</p>
                <p>Điện thoại: (+84) 326 450 840</p>
                <p>Giờ mở cửa: 8:00 sáng - 6:00 chiều</p>
            </div>
        </div>
    </div>
</body>
</html>
