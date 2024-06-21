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
    @endphp
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Email</th>
            <th>Ngày Đặt hàng</th>
            <th>Trạng Thái</th>
            <th>Giao Hàng</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
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


