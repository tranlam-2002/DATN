@extends('admin.main')

@section('content')
    <form action="" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Tên Tiêu Đề </label>
                    <input type="text" name ="name" value="{{$slider->name}}" class="form-control" placeholder="Nhập tên tiêu đề">
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Đường Dẫn </label>
                    <input type="text" name ="url" value="{{$slider->url}}" class="form-control" placeholder="Nhập tên đường dẫn">
                  </div>
                  </div>
                 </div>
                    <!-- <label for="customFile">Custom File</label> -->
                    <div class="form-group">
                      <label for="menu">Ảnh Sản Phẩm </label>
                          <input type="file" class="form-control" id="upload">
                        <div id="image_show">
                          <img src="{{$slider->thumb}}" width="100px">
                          
                        </div>
                        <input type="hidden" name="thumb" value="{{$slider->thumb}}" id="thumb">
                    </div>
                    
                    
                 
                  <div class="form-group">
                    <label for="menu">Sắp Xếp</label>
                    <input type="number" name="sort_by" value="{{$slider->sort_by}}" class="form-control">
                  </div>
                  
                    <div class="form-group">
                      <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                          {{$slider->active = 1 ? 'checked' : '' }}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked=""
                          {{$slider->active = 0 ? 'checked' : '' }}>
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                    </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
                @csrf
              </form>
@endsection