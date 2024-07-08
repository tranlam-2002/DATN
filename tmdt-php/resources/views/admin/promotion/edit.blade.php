@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <label>Tên Khuyến Mại</label>
                    <input type="text" name ="name" value="{{$promotion->name}}" class="form-control" placeholder="Nhập tên khuyến mại">
                  </div>
                  </div>
                </div>

                  <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea name="description" class="form-control" placeholder="Enter ..." style="text-align: start;">{{$promotion->description}}</textarea>
                  </div>

                  <div class="form-group">
                    <label>Mô Tả Chi Tiết</label>
                    <textarea id="content" class="form-control" name="content" rows="3" placeholder="Enter ..." style="text-align: start;">{{$promotion->content}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="menu">Ảnh Khuyến Mại</label>
                    <input type="file" class="form-control" id="upload">
                  <div id="image_show">
                        <a href="{{$promotion->thumb}}" target="_blank">
                          <img src="{{$promotion->thumb}}" width="100px">
                        </a>
                  </div>
                  <input type="hidden" name="thumb" value="{{$promotion->thumb}}" id="thumb">
                  </div>

                    <div class="form-group">
                      <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                          {{$promotion->active = 1 ? 'checked' : ''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked=""
                          {{$promotion->active = 0 ? 'checked' : ''}}>
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                    </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật Khuyến Mại</button>
                  <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary ms-auto">Quay Lại Danh Sách</a>
                </div>
                @csrf
              </form>
@endsection
