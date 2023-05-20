<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @if(Auth::guard('teacher')->check())
            @include('layouts.main-sidebar.teacher-sidebar')

        @elseif(Auth::guard('web')->check())
            @include('layouts.main-sidebar.admin-sidebar')
            
        @endif
        <!--=================================
 Main content -->
        <!-- main-content -->
        @if(Auth::guard('student')->check())
        <div class="content-wrapper" style="margin:70px 0 0 0">
        @elseif(Auth::guard('parent')->check())
        <div class="content-wrapper" style="margin:70px 0 0 0">
        @else
        <div class="content-wrapper" style="margin-top:70px">
        @endif
            @yield('page-header')

            @yield('content')

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

    @if(Auth::guard('student')->check())
    <script>
        $(document).ready(function(){

            $('.footer').css('left',0);
            $('.footer').css('right',0);

        })
       
    </script>

    @endif
    
</body>

</html>
