@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Tên Sản Phẩm </label>
                    <input type="text" name ="name" value="{{$product->name}}" class="form-control" placeholder="Nhập tên sản phẩm">
                  </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Danh Mục</label>
                     <select class="form-control" name="menu_id">
                      <option value="0"> Danh Mục Cha</option>
                      <option value="1"> Điện thoại</option>
                      <option value="2"> Máy tính bảng</option>
                      <option value="3"> Laptop </option>
                      <option value="4"> Linh kiện máy tính</option>
                      <option value="5"> Tai nghe</option>
                      <option value="6"> Màn hình máy tính</option>
                      @foreach ($menus as $menu)
                      <option value="{{$menu->id}}"{{$product->menu_id = $menu->id ? 'selected' : ''}}> 
                      {{$menu->name}}
                      </option>
                      @endforeach //để truy vấn ID xem có trùng với danh mục cha ko
                    </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="menu">Giá Gốc</label>
                    <input type="number" name="price" value="{{$product->price}}" class="form-control">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                   <div class="form-group">
                    <label for="menu">Giá Giảm</label>
                    <input type="number" name="price_sale" value="{{$product->price_sale}}" class="form-control">
                    </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea name ="description" class="form-control" placeholder="Enter ..." style="text-align: start;">{{$product->description}}</textarea>
                  </div>
                 <div class="form-group" >
                    <label>Mô Tả Chi Tiết</label>
                    <textarea id = "content" class="form-control" name ="content" rows="3" placeholder="Enter ..." style="text-align: start;">{{$product->content}}</textarea>
                  </div>
                   <div class="form-group">
                    <!-- <label for="customFile">Custom File</label> -->
                    <label for="menu">Ảnh Sản Phẩm </label>
                    <input type="file" class="form-control" id="upload">
                  <div id="image_show">
                        <a href="{{$product->thumb}}" target="_blank">
                          <img src="{{$product->thumb}}" width="100px">
                        </a>
                  </div>
                  <input type="hidden" name="thumb" value="{{$product->thumb}}" id="thumb">
                  </div>

                    <div class="form-group">
                      <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                          {{$product->active = 1 ? 'checked=""' : '' }}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked=""
                          {{$product->active = 0 ? 'checked=""' : '' }}>
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                    </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
                </div>
                @csrf
              </form>
@endsection