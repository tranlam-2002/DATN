@extends('account.layouts')

@section('account-content')
    <div class="main-content-wrapper">
        <h2>Lịch sử đơn hàng</h2>
        @include('alert')
        @if($customers->isEmpty())
            <p>Bạn chưa có đơn hàng nào.</p>
        @else
            @php
                $statusTexts = [
                    'pending' => 'Chờ duyệt',
                    'approved' => 'Đã duyệt',
                    'shipped' => 'Giao hàng',
                ];
                $deliveredTexts = [
                    '0' => 'Đang chờ giao hàng',
                    '1' => 'Giao hàng thành công'
                ];
                $paymentMethods = [
                    'cash_on_delivery' => 'Thanh toán khi nhận hàng',
                    'payment_at_store' => 'Thanh toán tại cửa hàng',
                    'vnpay' => 'Thanh toán bằng VNPAY',
                ];
            @endphp

            <table class="table">
                <thead>
                <tr>
                    <th style="width: 100px">Mã ĐH</th>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th> 
                    <th>Giao Hàng</th>
                    <th>Thanh Toán</th>
                    <th>Ngày Đặt hàng</th>
                    <th style="width: 100px">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $deliveredTexts[$customer->delivered] }}</td>
                        <td>{{ $paymentMethods[$customer->payment_method] ?? 'N/A' }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('orders.show', $customer->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')){document.getElementById('delete-form-{{ $customer->id }}').submit();}">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="delete-form-{{ $customer->id }}" action="{{ route('orders.destroy', $customer->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
            <div class="card-footer clearfix">
                {!! $customers->links() !!}
            </div>
        @endif
    </div>
@endsection
