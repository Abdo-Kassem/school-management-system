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
        @include('../layouts/main-sidebar/admin-sidebar')
        
        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">Admin Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- subject -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <a href="{{route('book.index')}}">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <span class="text-danger">
                                            <i class="fa fa-book" aria-hidden="true" style="font-size:30px"></i>
                                        </span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">{{__('dashboard_trans.books')}}</p>
                                        <h4>{{$booksCount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <a href="{{route('teacher.index')}}">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <span class="text-warning">
                                            <i class="fa fa-user" aria-hidden="true" style="font-size:30px"></i>
                                        </span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">{{__('dashboard_trans.teachers')}}</p>
                                        <h4>{{$teacherCount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
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
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <a href="{{route('student_fees.index')}}">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <span class="text-primary">
                                            <i class="fa fa-money" aria-hidden="true" style="font-size:30px"></i>
                                        </span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">{{__('dashboard_trans.student_fees')}}</p>
                                        <h4>{{$studentFeesCount}}</h4>
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
                                                    aria-selected="true" onclick="show(this)">{{__('dashboard_trans.books')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="teacher" data-toggle="tab" href="#teacher"
                                                    role="tab" aria-controls="teacher" aria-selected="false" onclick="show(this)">{{__('dashboard_trans.teachers')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="student" data-toggle="tab" href="#student" onclick="show(this)"
                                                    role="tab" aria-controls="student" aria-selected="false">{{__('dashboard_trans.students')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="student_fees" data-toggle="tab" href="#student_fees" onclick="show(this)"
                                                    role="tab" aria-controls="student_fees" aria-selected="false">{{__('dashboard_trans.student_fees')}}
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
                                    <div class="tab-pane fade custom-hide" id="teacher" role="tabpanel" aria-labelledby="teachers-tab" belong_to='teacher'>
                                        <div class="table-responsive">
                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('teacher_trans.teacher_name') }}</th>
                                                        <th>{{ trans('teacher_trans.gender') }}</th>
                                                        <th>{{ trans('teacher_trans.joining_date') }}</th>
                                                        <th>{{ trans('teacher_trans.specialization') }}</th>
                                                        <th>{{ trans('teacher_trans.grade') }}</th>
                                                        <th>{{ trans('teacher_trans.address') }}</th>
                                                        <th>{{ trans('teacher_trans.phone') }}</th>
                                                        <th>{{ trans('teacher_trans.operation') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $i = 0; ?>

                                                    @foreach ($teachers as $teacher)
                                                        <tr>
                                                            <?php $i++; ?>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $teacher->name }}</td>
                                                            <td><?php echo trans('teacher_trans.gender_'.$teacher->gender) ?></td>
                                                            <td>{{ $teacher->joining_date }}</td>
                                                            <td>{{ $teacher->specialization->name }}</td>
                                                            <td>{{ $teacher->grade->name }}</td>
                                                            <td>{{ $teacher->address }}</td>
                                                            <td>{{ $teacher->phone }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                    data-target="#edit{{ $teacher->id }}"
                                                                    title="{{ trans('teacher_trans.edit') }}"><i class="fa fa-edit"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                    data-target="#delete{{ $teacher->id }}"
                                                                    title="{{ trans('teacher_trans.delete') }}"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade custom-hide" id="student" role="tabpanel" aria-labelledby="student-tab" belong_to='student'>
                                        <div class="table-responsive">
                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                style="text-align: center">
                                                <thead>
                                                <tr>
                                                    <th>{{ trans('student_trans.student_name') }}</th>
                                                    <th>{{ trans('student_trans.email') }}</th>
                                                    <th>{{ trans('student_trans.gender') }}</th>
                                                    <th>{{ trans('student_trans.acadimy_year') }}</th>
                                                    <th>{{ trans('student_trans.birth.date') }}</th>
                                                    <th>{{ trans('student_trans.address') }}</th>
                                                    <th>{{ trans('student_trans.religion') }}</th>
                                                    <th>{{ trans('student_trans.grade') }}</th>
                                                    <th>{{ trans('student_trans.operation') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td><?php echo trans('student_trans.gender_'.$student->gender) ?></td>
                                                        <td>{{ $student->academic_year }}</td>
                                                        <td>{{ $student->birth_date }}</td>
                                                        <td>{{ $student->address }}</td>
                                                        <td>{{ $student->religion->name }}</td>
                                                        <td>{{ $student->grade->name }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <button type="button" class="text-success dropdown-item" data-toggle="modal"
                                                                        data-target="#edit{{ $student->id }}">
                                                                        <i class="fa fa-edit" style='margin:2px'></i>
                                                                        {{ trans('student_trans.edit') }}
                                                                    </button>
                                                                    <button type="button" class="text-danger dropdown-item" data-toggle="modal"
                                                                        data-target="#delete{{ $student->id }}">
                                                                        <i class="fa fa-trash" style='margin:2px'></i>{{ trans('student_trans.delete') }}
                                                                    </button>
                                                                    <a href="{{route('student.show',$student->id)}}" class="text-warning dropdown-item" >
                                                                        <i class="fa fa-eye" style='color:red;margin:2px'></i>
                                                                        {{ trans('student_trans.show') }}
                                                                    </a>
                                                                    <a href="{{route('student_fees.create',$student->id)}}" class="text-warning dropdown-item" >
                                                                        <i class="fa fa-plus" style='margin:2px'></i>
                                                                        {{ trans('student_trans.addStudentFees') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade custom-hide" id="student_fees" role="tabpanel" aria-labelledby="student_fees-tab" belong_to='student_fees'>
                                        <div class="table-responsive">
                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('fee_trans.studentName') }}</th>
                                                        <th>{{ trans('fee_trans.acadimic.year') }}</th>
                                                        <th>{{ trans('fee_trans.grade') }}</th>
                                                        <th>{{ trans('fee_trans.class') }}</th>
                                                        <th>{{ trans('fee_trans.type') }}</th>
                                                        <th>{{ trans('fee_trans.credit') }}</th>
                                                        <th>{{ trans('fee_trans.debit') }}</th>
                                                        <th>{{ trans('fee_trans.remaining') }}</th>
                                                        <th>{{ trans('fee_trans.adding.date') }}</th>
                                                        <th>{{ trans('fee_trans.operation') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($studentFees as $studentFee)
                                                    <tr>
                                                        <td>{{ $studentFee->student->name }}</td>
                                                        <td>{{ $studentFee->student->academic_year }}</td>
                                                        <td>{{ $studentFee->student->grade->name }}</td>
                                                        <td>{{ $studentFee->student->class->name }}</td>
                                                        <td><?php echo $studentFee->studyFees->type===1?trans('fee_trans.study.fees'):trans('fee_trans.bus.fees') ?></td>
                                                        <td>{{ $studentFee->credit }}</td>
                                                        <td>{{ $studentFee->debit }}</td>
                                                        <td>{{ $studentFee->credit-$studentFee->debit }}.00</td>
                                                        <td>{{ $studentFee->created_at }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $studentFee->id }}" title="{{ trans('fee_trans.studentFeesUpdate') }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{ $studentFee->id }}" title="{{ trans('fee_trans.studentFeesDelete') }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            
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
        
            <!--=================================
 footer -->

            @include('layouts.footer')
    </div>
    <!--=================================
 footer -->
   
    @include('layouts.footer-scripts')
    
    <script src="{{URL::asset('assets/js/custom/adminDashboard.js')}}"></script>
    @livewireScripts
    @stack('scripts')

    <script>
        $('#main').attr('class','active_my');
    </script>

</body>

</html>