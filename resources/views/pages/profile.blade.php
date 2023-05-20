@extends('layouts.master')


@section('title')
    {{__('teacher_trans.profile')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('teacher_trans.profile')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="card-body">
        @if (session()->has('fail'))
            <div class="alert alert-danger">
                {{session('fail')}}
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{URL::asset('assets/images/admin.png')}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 style="font-family: Cairo" class="my-3">{{$admin->name}}</h5>
                            <p class="text-muted mb-1">{{$admin->email}}</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{route('admin_profile.update')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{__('admin_trans.name')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name"
                                                   value="{{ $admin->name }}"
                                                   class="form-control">
                                            @error('name')
                                                <p class=' text-danger' >{{$message}}</p>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{__('admin_trans.email')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="email"
                                                   value="{{ $admin->email }}"
                                                   class="form-control">
                                            @error('email')
                                                <p class=' text-danger' >{{$message}}</p>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{__('admin_trans.password')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password" class="form-control" name="password">
                                            @error('password')
                                                <p class=' text-danger' >{{$message}}</p>
                                            @enderror
                                        </p><br><br>
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                               id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">{{__('admin_trans.password_display')}}</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">{{__('teacher_trans.update')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection
@section('js')
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
@endsection