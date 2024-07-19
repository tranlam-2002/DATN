<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body > 
	
	<!-- Header -->
	@include('header')

	<!-- Cart -->
    @include('cart')
    
	
	{{-- product details --}}
	@yield('content')

	<!-- Footer -->
    @include('footer')
	
	{{-- Phần liên hệ nhanh --}}
    @include('contact-section')

</body>
</html>