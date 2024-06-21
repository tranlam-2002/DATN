@extends('admin.main')

@section('content')
    <div class="main-content-wrapper">
        @if($customers->isEmpty())
            <p>Không có đơn hàng nào.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>
                            <form action="{{ route('admin.carts.updateStatus', $customer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $customer->status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="approved" {{ $customer->status == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                                    <option value="shipped" {{ $customer->status == 'shipped' ? 'selected' : '' }}>Giao hàng</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow({{ $customer->id }}, '/admin/customers/destroy')">
                                <i class="fas fa-trash"></i>
                            </a>
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
