@extends('account.layouts')

@section('account-content')
    <div class="main-content-wrapper">
        <h2>Chi tiết đơn hàng</h2>

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
                <h4 class="p-t-10px">Thông Tin Khách Hàng</h4>
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
                    <th class="column-1">Ảnh</th>
                    <th class="column-2">Sản phẩm</th>
                    <th class="column-3">Giá</th>
                    <th class="column-4">Số lượng</th>
                    <th class="column-5">Tổng</th>
                </tr>

                @foreach($carts as $key => $cart)
                    @php
                        $price = $cart->price * $cart->pty;
                        $total += $price;
                    @endphp
                    <tr>
                        <td class="column-1">
                            <div class="how-item">
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
                        <td >{{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                    <tr>
                       <td colspan="5" class="text-right">
                            @if($customer->status === 'shipped' && !$customer->delivered)
                                <form action="{{ route('orders.showPut', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Đã nhận được hàng</button>
                                </form>
                            @elseif($customer->delivered)
                                <span class="text-success">Giao hàng thành công</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right p-b-10 p-r-10">
        <a href="{{ route('account.orders') }}" class="btn btn-secondary">Quay Lại Danh Sách</a>
    </div>
        </div>
    </div>
@endsection
