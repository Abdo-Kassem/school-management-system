@extends('layouts.master')

@section('title')
    {{__('attendance_trans.title_page')}}
@endsection

@section('page-header')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="text-transform:capitalize; color:#707070"> {{__('attendance_trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="default-color">{{__('breadcrump_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('attendance_trans.title_page')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div id="accordion">
                @foreach($grades as $grade)
                    <div class="card">
                        <div class="card-header" id="heading{{$grade->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link w-100" data-toggle="collapse" data-target="#classroom{{$grade->id}}" aria-expanded="true">
                                    {{$grade->name}}
                                </button>
                            </h5>
                        </div>

                        <div id="classroom{{$grade->id}}" class="collapse" aria-labelledby="heading{{$grade->id}}" data-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('classes_trans.study_year_name') }}</th>
                                                <th>{{ trans('classroom_trans.classroomName') }}</th>
                                                <th>{{ trans('classes_trans.operations') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; $ids=''; ?>

                                            @foreach ($grade->classes as $class)
                                            @foreach($class->classeRooms as $classroom)
                                            <?php $ids = $grade->id.' '.$class->id.' '.$classroom->id;?>
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $class->name }}</td>
                                                <td>{{ $classroom->name }}</td>
                                                <td>
                                                    <a href="{{route('student-attendance.show',$ids)}}" class="btn btn-info btn-sm" >
                                                        <i class="fa fa-eye"></i>
                                                        {{ trans('classes_trans.show') }}
                                                    </a>
                                                </td>
                                             </tr>
                                             <?php $ids='';?>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>   

        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
