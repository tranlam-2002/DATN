@extends('admin.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <form action="{{ route('admin.products.search') }}" method="GET">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request()->query('search') }}">
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
      <th>ID</th>
      <th style="width: 300px;">Tên Sản Phẩm</th>
      <th>Danh Mục</th>
      <th>Giá Gốc</th>
      <th>Giá Khuyến Mại</th>
      <th>Số Lượng</th>
      <th>Ảnh SP</th>
      <th>Active</th>
      <th>Update</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->menu_id }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->price_sale }}</td>
        <td>{{ $product->quantity }}</td>
        <td>
          <a href="{{ $product->thumb }}" target="_blank">
            <img src="{{ $product->thumb }}" height="40px">
          </a>
        </td>
        <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
        <td>{{ $product->updated_at }}</td>
        <td>
          <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
            <i class="fas fa-edit"></i>
          </a>
          <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
            <i class="fas fa-trash"></i>
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="card-footer clearfix">
  {!! $products->links() !!}
</div>

@endsection
