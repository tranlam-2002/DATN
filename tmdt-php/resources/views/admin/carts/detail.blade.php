@extends('admin.main')

@section('content')
    <div class="customer mt-3">
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
                    <strong style="color: rgb(90, 216, 90);">
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
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">IMG</th>
                <th class="column-2">Product</th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-5">Total</th>
            </tr>

            @foreach($carts as $key => $cart)
                @php
                    $price = $cart->price * $cart->pty;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 200px">
                        </div>
                    </td>
                    <td class="column-2">{{ $cart->product->name }}</td>
                    <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                    <td class="column-4">{{ $cart->pty }}</td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng Tiền</td>
                    <td>{{ number_format($total, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-right p-b-10 p-r-15">
            <a href="/admin/customers/status" class="btn btn-secondary">Quay Lại Danh Sách</a>
        </div>
    </div>
@endsection


