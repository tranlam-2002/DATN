@extends('admin.main')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tên Tiêu Đề</th>
      <th>Ảnh</th>
      <th>Trạng Thái</th>
      <th>Cập Nhật</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    @foreach($promotions as $key => $promotion)
              <tr> 
                <td>{{ $promotion->id }}</td>
                <td>{{ $promotion->name }}</td>
                <td>
                  <a href="{{ $promotion->thumb }}" target="_blank">
                      <img src="{{ $promotion->thumb }}" height="40px">
                  </a>
                </td>
                <td>{!! \App\Helpers\Helper::active($promotion->active) !!}</td>
                <td>{{ $promotion->updated_at }}</td>
                <td>
                <a class="btn btn-primary btn-sm" href="/admin/promotions/edit/{{ $promotion->id }}">
                    <i class="fas fa-edit"></i> </a>
                <a href="#" class="btn btn-danger btn-sm" 
                onclick="removeRow({{ $promotion->id }}, '/admin/promotions/destroy')">
                    <i class="fas fa-trash"></i> </a>
                </td>
              </tr>
    @endforeach
  </tbody>
</table>
{!! $promotions->links() !!}
@endsection
