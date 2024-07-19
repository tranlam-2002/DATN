<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body > 
	{{-- <div class="animsition"> --}}
	<!-- Header -->
	@include('header')

	<!-- Cart -->
    {{-- @include('cart') --}}
    
	{{-- product details --}}
	@yield('content')


	<!-- Footer -->
    @include('footer')
	
	{{-- </div> --}}
	
</body>
</html>