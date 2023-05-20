<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel='stylesheet' href="{{URL::asset('assets\css\auth_style.css')}}">
        <style>
            .header {
                width: 50%;
                background-color: white;
                margin: 0 auto 35px;
                padding: 15px 26px;
            }
            .header img {
                display: block;
                width: 100%;
            }

            .form-label {
                color: #747474;
                font-size: 19px;
                text-transform: capitalize;
            }

            .message {
                display: inline-block;
                color: brown;
                padding: 4px 0;
            }

            button {
                width:100%;
                text-transform: capitalize;
            }
        </style>
    </head>
    <body class="font-sans antialiased">

        <div class="row justify-content-center align-items-center vh-100" >
            <!-- Page Content -->
            <main class='col-6 bg-light p-5'>
                <div class="header">
                    <img src="{{URL::asset('assets\images\logo-dark.png')}}" alt="">
                </div>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    @if(!isset($messages))
                    <div class="mb-3" id='token'>

                        <label for="code" class="form-label">enter sended five number</label>
                        <input type="text" class="form-control" id="code" name='token'>
                        <span class='message' id='message'></span>
                        
                    </div>
                    @endif
                    @if(isset($messages))
                    <div id='password' >
                    @else
                    <div id='password' style='display:none'>
                    @endif
                        <div class="mb-3">
                            <label for="old-password" class="form-label">New Password</label>
                            <input type="text" class="form-control" id="old-password" name='password'>
                            @if(isset($messages))
                                @foreach($messages['password'] as $message)
                                    <span class='message' style="display:block">{{$message}}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="new-password" class="form-label">Confirm Password</label>
                            <input type="text" class="form-control" id="new-password" name='password_confirmation'>
                        </div>

                        <input type="hidden" value='{{$email}}' name="email">

                        <button type="submit" class='btn btn-success'>reset</button>

                    </div>
                    
                </form> 
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            $('document').ready(function() {
                password = $('#password');
            
                $('#code').change(function() {
                    
                    $.ajax({
                        method : 'get',
                        url : 'reset-password-ajax',
                        data : {token : $(this).val(),email : "{{$email}}"},

                        success : function(data) {
                           
                            if(data == 10) {
                                $('#message').text('please not change email');
                            }
                            else if(data == true) {
                        
                                password.css('display','block');
                                $('#token').css('display','none');
                            }else {
                            
                                $('#message').text('please enter valide code');
                            }
                            
                        }
                       
                    });

                });
            });
        </script>
    </body>
</html>
