<header class="header-v4">
@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
	<!-- Header desktop -->
		<div class="container-menu-desktop">
				<!-- Topbar -->
					<div class="top-bar">
						<div class="content-topbar flex-sb-m h-full container">
							<div class="left-top-bar ">
								<button class="btn btn-promotion" onclick="window.location.href='/promotions'" 
								style="color: #f5f4f9; font-family: Poppins-Regular; font-size: 12px;">Khuyến mại</button>
							</div>

							<div class="right-top-bar flex-w h-full">
								@include('fe.index')
							</div>
						</div>
					</div>


			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					<!-- Logo desktop -->		
					<a href="/home" class="logo">
						<img src="/template/images/icons/logo-03.png" alt="IMG-LOGO">
					</a>
					
					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu"><a href="/">Trang Chủ</a>
							
								{!! $menusHtml !!}
							<li>
								<a href="{{ route('contact') }}">Liên Hệ</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
						 data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="{{ route('account.index') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" 
						data-notify="{{ Auth::check() ? 1 : 0 }}">
							<i class="fa fa-user-circle"></i>
						</a>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="/"><img src="/template/images/icons/logo-03.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" 
				data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="{{ route('account.index') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" 
				data-notify="{{ Auth::check() ? 1 : 0 }}">
					<i class="fa fa-user-circle"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">

			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						<a href="/promotions" class="cl4" style="color: #f7f4f4">
							Khuyến mại
						</a>
						
					</div>
				</li>
				<li>
					<div class="right-top-bar flex-w">
						@include('fe.index')
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
					<li class="active-menu"><a href="/">Trang Chủ</a></li>
						{!! $menusHtml !!}
					<li>
						<a href="{{ route('contact') }}">Liên Hệ</a>
					</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="/template/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" action="{{ route('search') }}" method="GET">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
</header>