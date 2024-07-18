@extends('admin.main')

@section('content')
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
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.customers.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm đơn hàng..." value="{{ request()->query('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" style="background-color:rgba(255, 0, 0, 0.838);border-color:red;">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Email</th>
            <th>Thanh Toán</th>
            <th>Ngày Đặt hàng</th>
            <th>Trạng Thái</th>
            <th>Giao Hàng</th>
            <th style="width: 50px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $paymentMethods[$customer->payment_method] ?? 'N/A' }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $statusTexts[$customer->status] ?? 'Không xác định' }}</td>
                <td>{{ $deliveredTexts[$customer->delivered] }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection


