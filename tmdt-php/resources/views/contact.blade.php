@extends('welcome')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<!-- Slider -->
<section class="slider-section">
    <div class="container">
        <div class="slider">
            <div><img src="template/images/khuyenmai-1.webp" alt="Image 1"></div>
            <div><img src="template/images/khuyenmai-2.webp" alt="Image 2"></div>
            <div><img src="template/images/khuyenmai-3.webp" alt="Image 3"></div>
            <div><img src="template/images/khuyenmai-4.webp" alt="Image 4"></div>
        </div>
        <!-- Nút mũi tên -->
        <button class="slick-prev"><i class="fas fa-chevron-left"></i></button>
        <button class="slick-next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

<!-- Title page -->
<section class="">
      <h2 class="txt-center">
      Liên Hệ
    </h2>  
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                @include('alert')
                <form action="{{ route('postContact') }}" method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Gửi Tin Nhắn Cho Chúng Tôi
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Nhập Địa Chỉ Email" required>
                        <img class="how-pos4 pointer-none" src="template/images/icons/icon-email.png" alt="ICON">
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="Chúng Tôi Có Thể Giúp Gì Cho Bạn?" required></textarea>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Gửi
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Địa Chỉ
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Liên Hệ
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            (+84) 326 450 840 
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Hỗ Trợ 
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            Email@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            prevArrow: '.slick-prev',
            nextArrow: '.slick-next',
            dots: true
        });
    });
</script>

<style>
    .slider-section {
        margin-top: 40px;
        margin-bottom: 40px;
        text-align: center;
        position: relative;
    }
    .slider img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .slick-prev, .slick-next {
        background-color: #333;
        color: #fff;
        border-radius: 50%;
        padding: 10px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }
    .slick-prev {
        left: 15px;
    }
    .slick-next {
        right: 15px;
    }
    .slick-prev:hover, .slick-next:hover {
        background-color: #555;
    }
</style>

@endsection
