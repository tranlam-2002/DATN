@extends('account.layouts')

@section('account-content')
    <div class="main-content-wrapper">
        <h2>Lịch sử đơn hàng</h2>
        @include('alert')

        @if($customers->isEmpty())
            <p>Bạn không có đơn hàng nào.</p>
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
            <!-- Thêm Form Tìm Kiếm -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('account.orders') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm đơn hàng..." value="{{ request()->query('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table order-list">
                <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th class="hidden-xs">Tên Khách Hàng</th>
                    <th class="hidden-xs">Số Điện Thoại</th>
                    <th>Giao Hàng</th>
                    <th class="hidden-xs">Thanh Toán</th>
                    <th>Ngày Đặt hàng</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td class="hidden-xs">{{ $customer->name }}</td>
                        <td class="hidden-xs">{{ $customer->phone }}</td>
                        <td>{{ $deliveredTexts[$customer->delivered] }}</td>
                        <td class="hidden-xs">{{ $paymentMethods[$customer->payment_method] ?? 'N/A' }}</td>
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
