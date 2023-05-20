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
        @include('../layouts/main-sidebar/teacher-sidebar')
        
        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            
            <!-- subject -->
            <div class="row">
                <div class="col mb-30">
                    <div class="card card-statistics h-100">
                        <a href="{{route('student.index')}}">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <span class="text-success">
                                            <i class="fa fa-user" aria-hidden="true" style="font-size:30px"></i>
                                        </span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">{{__('dashboard_trans.students')}}</p>
                                        <h4>{{$studentCount}}</h4>
                                    </div>
                                </div>
                            
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="card card-statistics h-100">
                        <a href="{{route('classe.rooms')}}">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <span class="text-primary">
                                        <i class="fa fa-home" aria-hidden="true" style="font-size:30px"></i> 
                                        </span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">{{__('dashboard_trans.classroomNumber')}}</p>
                                        <h4>{{$classroomCount}}</h4>
                                    </div>
                                </div>
                            
                            </div>
                        </a>
                    </div>
                </div>
            </div> 
            <!-- Orders Status widgets-->
            
            <div class="row">
                <div class="col">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 class="card-title">{{__('dashboard_trans.last_five_operation')}}</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="books" data-toggle="tab"
                                                    href="#books" role="tab" aria-controls="books"
                                                    aria-selected="true" onclick="show(this)">{{__('dashboard_trans.bookHeader')}}</a>
                                            </li>
                                            <li class="nav-iatem">
                                                <a class="nav-link" id="quizze" data-toggle="tab" href="#quizze"
                                                    role="tab" aria-controls="teacher" aria-selected="false" onclick="show(this)">{{__('dashboard_trans.quizze')}}
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show custom-hide" id="books" role="tabpanel"
                                        aria-labelledby="books" belong_to='books'>
                                        <div class="table-responsive">
                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('book_trans.name')}}</th>
                                                        <th>{{trans('book_trans.teacherName')}}</th>
                                                        <th>{{trans('book_trans.grade')}}</th>
                                                        <th>{{trans('book_trans.class')}}</th>
                                                        <th>{{trans('book_trans.created_at')}}</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($books as $book)
                                                        <tr>
                                                            <td>{{ $loop->iteration}}</td>
                                                            <td>{{$book->title}}</td>
                                                            <td>{{$book->teacher->name}}</td>
                                                            <td>{{$book->grade->name}}</td>
                                                            <td>{{$book->class->name}}</td>
                                                            <td>{{$book->added_at}}</td>
                                                            <td>
                                                                <a href="{{route('book.download',$book->file_name)}}" title="{{trans('book_trans.download')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-download"></i></a>
                                                                <button data-target="#edit{{$book->id}}" class="btn btn-info btn-sm" role="button" data-toggle="modal" title="{{trans('book_trans.edit')}}"><i class="fa fa-edit"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $book->id }}" title="{{trans('book_trans.delete')}}"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade custom-hide" id="quizze" role="tabpanel" aria-labelledby="quizze-tab" belong_to='quizze'>
                                        <div class="table-responsive">
                                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                                    data-page-length="50"
                                                    style="text-align: center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('quizz_trans.name')}}</th>
                                                        <th>{{trans('quizz_trans.grade')}}</th>
                                                        <th>{{trans('quizz_trans.class')}}</th>
                                                        <th>{{trans('quizz_trans.classroom')}}</th>
                                                        <th>{{trans('quizz_trans.subject')}}</th>
                                                        <th>{{trans('quizz_trans.teacherName')}}</th>
                                                        <th>{{trans('quizz_trans.operation')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($quizzes as $quizz)
                                                        <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$quizz->name}}</td>
                                                        <td>{{$quizz->grade->name}}</td>
                                                        <td>{{$quizz->class->name}}</td>
                                                        <td>{{$quizz->classroom->name}}</td>
                                                        <td>{{$quizz->subject->name}}</td>
                                                        <td>{{$quizz->teacher->name}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $quizz->id }}" title="{{trans('quizz_trans.delete')}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $quizz->id }}" title="{{trans('quizz_trans.edit')}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                
                                                                <a href="{{route('questions.index',$quizz->id)}}" class="btn btn-primary btn-sm"  title="{{trans('quizz_trans.show')}}">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- calender-->

            <livewire:calendar />
            <!--end calender-->
        </div>
                 
    </div>
    <!--=================================
 footer -->
    @include('layouts.footer')
    <!--=================================
 footer -->
   
    @include('layouts.footer-scripts')
    
    <script src="{{URL::asset('assets/js/custom/adminDashboard.js')}}"></script>
    <script src="{{ URL::asset('assets/js/custom/makeActive.js') }}"></script>
    @livewireScripts
    @stack('scripts')

    <script>
        $('#main').attr('class','active_my');
    </script>

</body>

</html>