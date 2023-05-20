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
            margin-left: 0;
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
        <div class="content-wrapper" style="padding-top:80px">
            
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

</body>

</html>