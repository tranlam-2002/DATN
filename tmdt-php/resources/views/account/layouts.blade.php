    @extends('welcome')
    
    @section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/template/css/account.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light account-sidebar">
                @include('account.sidebar')
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto px-4 main-content">
                <div class="main-content-wrapper">
                    @yield('account-content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile navigation -->
    <div class="mobile-nav">
        <a href="{{ route('account.index') }}" class="@if(request()->routeIs('account.index')) active @endif">
            <i class="fas fa-user"></i>
        </a>
        <a href="{{ route('account.edit') }}" class="@if(request()->routeIs('account.edit')) active @endif">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('account.change-password') }}" class="@if(request()->routeIs('account.change-password')) active @endif">
            <i class="fas fa-key"></i>
        </a>
        <a href="{{ route('account.orders') }}" class="@if(request()->routeIs('account.orders')) active @endif">
            <i class="zmdi zmdi-shopping-cart"></i>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                var url = $(this).attr('href');
                $.get(url, function(data) {
                    $('.main-content-wrapper').html($(data).find('.main-content-wrapper').html()); 
                });
            });
        });
    </script>

@endsection