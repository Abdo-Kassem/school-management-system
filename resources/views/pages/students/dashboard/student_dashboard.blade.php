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
    @livewireStyles
    <style>
        .content-wrapper{
            margin-right: 0;
        }  
    </style>
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

        @include('../layouts.main-header')
       
        
        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper" style="margin:70px 0">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="text-transform:capitalize">{{__('dashboard_trans.welcome')}} {{Auth::guard('student')->user()->name}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
           
           
            <!-- calender-->

            <livewire:studentcalendar />
            <!--end calender-->
        </div>
                 
    </div>
    <!--=================================
 footer -->
    @include('layouts.footer')
    <!--=================================
 footer -->
   
    @include('layouts.footer-scripts')
    
    
    @livewireScripts
    @stack('scripts')
    <script>
        $(document).ready(function(){

            $('.footer').css('left',0);
            $('.footer').css('right',0);

        })
       
    </script>

</body>

</html>