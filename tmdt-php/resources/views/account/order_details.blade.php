@extends('account.layouts')

@section('account-content')
    <div class="main-content-wrapper">
        <h2>Chi tiết đơn hàng</h2>

        <div class="customer mt-3">
            <ul>
                <h4>Thông Tin Khách Hàng</h4><br>
                <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
                <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
                <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
                <li>Email: <strong>{{ $customer->email }}</strong></li>
                <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
            </ul>
        </div>

        <div class="carts">
            @php $total = 0; @endphp
            <br><h4>Chi Tiết Đơn Hàng</h4><br>
            <table class="table">
                <tbody>
                <tr class="table_head">
                    <th class="column-1">IMG</th>
                    <th class="column-2">Product</th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                </tr>

                @foreach($carts as $key => $cart)
                    @php
                        $price = $cart->price;
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
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="3" class="text-right">Tổng Tiền</td>
                        <td>{{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
