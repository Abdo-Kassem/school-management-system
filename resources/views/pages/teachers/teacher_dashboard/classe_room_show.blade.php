@extends('layouts.master')

@section('title')
    {{__('classroom_trans.title_page')}}
@endsection

@section('page-header')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{__('classroom_trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teacher.home')}}" class="default-color">{{__('breadcrump_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('classroom_trans.title_page')}}</li>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('classroom_trans.classroomName') }}</th>
                                            <th>{{ trans('classroom_trans.status') }}</th>
                                            <th>{{ trans('classroom_trans.className') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>

                                        @foreach ($classrooms as $classroom)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $classroom->name }}</td>
                                            <td>
                                                <?php
                                                    if($classroom->status) 
                                                        echo __('classroom_trans.statusOn');
                                                    else
                                                        echo __('classroom_trans.statusOff');
                                                ?>
                                            </td>
                                            <td>{{ $classroom->classe->name }}</td>
                                           
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

<!-- row closed -->
@endsection
@section('js')
<script>
    $('#classroom').attr('class','active_my');
</script>
@endsection
