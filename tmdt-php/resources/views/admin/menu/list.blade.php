@extends('admin.main')

@section('content')
    <!-- Thêm Form Tìm Kiếm -->
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('admin.menus.searchMenus') }}" method="GET">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục..." value="{{ request()->query('search') }}">
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
                <th style="">ID</th>
                <th>Tên Danh Mục</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $menus->links() !!}
    </div>
@endsection
