<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel='stylesheet' href="{{URL::asset('assets\css\auth_style.css')}}">
    </head>
    <body class="font-sans antialiased">

        <div class="row justify-content-center align-items-center vh-100" >
            <!-- Page Content -->
            <main class='col-6 bg-light p-5'>
                <form action="{{route('login')}}" method='post'>
                    @csrf
                    @if($type == 'web') 
                    <div class="form-header text-primary">
                        {{trans('auth_trans.admin.login')}} 
                    </div>
                    @else
                    <div class="form-header text-primary">
                        {{trans('auth_trans.'.$type.'.login')}} 
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail address</label>
                        <input type="email" class="form-control" id="email" name='email'>
                       
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name='password'>
                    </div>
                  
                    <div class="mb-3  row" >

                        <div class='col'>
                            <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                    id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">{{__('teacher_trans.password_display')}}</label>
                        </div>
                        <div class='col'>
                            <input type="checkbox" class="form-check-input" id="remember-my" name='remember_me'>
                            <label class="form-check-label" for="remember-my">remember me</label>
                        </div>
                        
                    </div>
                    <div >
                        <input type="hidden" value="{{$type}}" name='guardName'>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">{{trans('auth_trans.login')}}</button>
                    <div style="width:100%;padding:10px;text-align:center">
                        <a href="{{route('password.request')}}"style="display:inline-block;padding:5px;text-decoration:none">Forget Password?</a>
                    </div>
                   
                </form>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            function myFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </body>
</html>

