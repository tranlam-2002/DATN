@extends('admin.main')

@section('content')
    <form action="" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Tên Tiêu Đề </label>
                    <input type="text" name ="name" value="{{old('name')}}" class="form-control" placeholder="Nhập tên tiêu đề">
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Đường Dẫn </label>
                    <input type="text" name ="url" value="{{old('url')}}" class="form-control" placeholder="Nhập tên đường dẫn">
                  </div>
                  </div>
                 </div>
                    <!-- <label for="customFile">Custom File</label> -->
                    <div class="form-group">
                      <label for="menu">Ảnh Sản Phẩm </label>
                          <input type="file" class="form-control" id="upload">
                        <div id="image_show">

                          
                        </div>
                        <input type="hidden" name="thumb" id="thumb">
                    </div>
                    
                    
                 
                  <div class="form-group">
                    <label for="menu">Sắp Xếp</label>
                    <input type="number" name="sort_by" value="1" class="form-control">
                  </div>
                  
                    <div class="form-group">
                      <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" >
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked="">
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                    </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo Slider</button>
                </div>
                @csrf
              </form>
@endsection