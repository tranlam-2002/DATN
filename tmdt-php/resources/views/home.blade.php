@extends('main')
    <link rel="stylesheet" href="{{ asset('/template/css/product.css') }}">
@section('content')
<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">

				@foreach($sliders as $slider)

				<!-- Thêm lớp d-none d-md-block để ẩn slider khi ở dạng mobile -->
				<div class="item-slick1 d-none d-md-block" style="background-image: url({{$slider->thumb}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2" style="color: white;">
									HOT 2024
								</span>
							</div>
									
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color: white;">
									{{$slider->name}}
								</h2>
							</div>
									
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{$slider->url}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Xem Thêm
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</section>


	<section class="sec-banner bg0 p-t-80 p-b-30 d-none d-md-block">
		<div class="container">
			<div class="row position-relative">
				<div class="promotion-container-wrapper" style="overflow: hidden;">
					<div class="promotion-container d-flex">

						@foreach($promotions as $promotion)
						<div class="col-md-6 col-xl-4 p-b-30 promotion-item">
							<!-- Block1 -->
							<div class="wrap-pic-w" style="overflow: hidden; border-radius: 10px;">
								<img src="{{ $promotion->thumb }}" alt="IMG-BANNER" style="width: 100%; border-radius: 10px;">
								<a href="{{ url('/promotions/' . $promotion->id) }}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
									<div class="block1-txt-child2 p-b-4 trans-05">
										<div class="block1-link stext-101 cl0 trans-09">
											Xem thêm
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<div class="image-container">
					<img src="/template/images/AsusSlider.jpg" alt="Asus Slider" style="width: 100%;">
				</div>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
             		<div class="container">
                        <div class="row">
                             <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/acer.jpg" alt="Brand 1" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/Asus.jpg" alt="Brand 2" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/hp.jpg" alt="Brand 3" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/msi.jpg" alt="Brand 4" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/Lenovo.jpg" alt="Brand 5" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/Amdo.jpg" alt="Brand 6" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/samsung.jpg" alt="Brand 7" class="img-fluid">
                        </div>

                        <div class="col-md-3 col-sm-6 brand-item mb-3">
                            <img src="/template/images/acer.jpg" alt="Brand 8" class="img-fluid">
                        </div>
                        </div>
                    </div>
				</div>
			
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>
			</div>
			
          {{-- DS Danh mục san pham --}}
		  <div id="">
			@include('product')
		  </div>

		{{-- slider vận chuyển --}}
		<div class="vanchuyen_cart">
			<div class="container">
				<div class="vanchuyen_thanhtoan_doitra">
				<div class="vanchuyen">
					<div class="img_icon_footer">
						<img src="/template/images/iconvanchuyen.png" alt="">
					</div>
					<div class="content_vc_tt_dt">
						<h4>Vận chuyển và lắp đặt miễn phí</h4>
						<p>Miễn phí vận chuyển 25km (*) </p>
					</div>
				</div>
				<div class="vanchuyen">
					<div class="img_icon_footer">
						<img src="/template/images/iconthanhtoan.png" alt="">
					</div>
					<div class="content_vc_tt_dt">
						<h4>Thanh toán dễ dàng</h4>
						<p>Dễ dàng lựa chọn phương thức phù hợp</p>
					</div>
				</div>
				<div class="vanchuyen">
					<div class="img_icon_footer">
						<img src="/template/images/iconDoitrahang.png" alt="">
					</div>
					<div class="content_vc_tt_dt">
						<h4>Đổi và trả hàng</h4>
						<p>Thời gian đỗi trả lên đến 30 ngày</p>
					</div>
				</div>
       			</div>
     		</div>
    	</div>
		  {{-- DS sản pham --}}
			<div id="loadProduct">
				<div class="p-b-30 p-t-30">
					<h4 class="ltext-105 txt-center" style="color: black; font-family: 'PhpDebugbarFontAwesome';">
						CÁC SẢN PHẨM DÀNH CHO BẠN
					</h4>
				</div>
				<div>
					@include('products.list')
				</div>
			</div>

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45" id ="button-loadMore">
				<input type="hidden" value="1" id="page">
				<a onclick="loadMore()" class="btn flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Xem thêm sản phẩm
				</a>
			</div>
		</div>
	</section>

@endsection