@extends('admin.main')

@section('content')
    <form action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên Danh Mục</label>
                    <input type="text" name ="name" value="{{$menu->name}}" class="form-control" placeholder="Nhập tên danh mục">
                  </div>
                  <div class="form-group">
                    <label >Danh Mục</label>
                    <select class="form-control" name="parent_id">
                    <option value="0" {{$menu->parent_id == 0 ? 'selected' : ''}}>Danh Mục Cha</option>
                      <option value="1" {{$menu->parent_id == 0 ? 'selected' : ''}}> Điện thoại</option>
                      <option value="2" {{$menu->parent_id == 0 ? 'selected' : ''}}> Máy tính bảng</option>
                      <option value="3" {{$menu->parent_id == 0 ? 'selected' : ''}}> Laptop </option>
                      <option value="4" {{$menu->parent_id == 0 ? 'selected' : ''}}> Linh kiện máy tính</option>
                      <option value="5" {{$menu->parent_id == 0 ? 'selected' : ''}}> Tai nghe</option>
                      <option value="6" {{$menu->parent_id == 0 ? 'selected' : ''}}> Màn hình máy tính</option>
                      @foreach ($menus as $menuParent)
                      <option value="{{$menuParent->id}}"
                        {{$menu->parent_id == $menuParent->id ? 'selected' : ''}}> 
                        {{$menuParent->name}}</option>
                      @endforeach //để truy vấn ID xem có trùng với danh mục cha ko
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea name ="description" class="form-control" style="text-align: start;">{{$menu->description}}</textarea>
                  </div>
                 <div class="form-group">
                    <label>Mô Tả Chi Tiết</label>
                      <textarea id = "content" class="form-control" name ="content" rows="3" placeholder="Enter ..." style="text-align: start;">{{$menu->content}}</textarea>
                  </div>
                    <div class="form-group">
                      <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                          name="active" {{$menu->active == 1 ? 'checked=""' : ''}} >
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked=""
                          name="active" {{$menu->active == 0 ? 'checked=""' : ''}}>
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
                </div>
                @csrf
              </form>
@endsection