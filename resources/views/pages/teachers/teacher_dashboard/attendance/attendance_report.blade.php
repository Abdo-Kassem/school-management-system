@extends('layouts.master')
@section('css')

@section('title')
    {{__('report_trans.attendance_page')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{__('report_trans.attendance_page')}}
@stop
<!-- breadcrumb -->

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"  action="{{ route('attendance.search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue"> {{__('report_trans.attendance_search_info')}}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{__('report_trans.students')}}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{__('report_trans.all')}}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <input type="text"  class="form-control range-from date-picker-default " 
                                    placeholder="{{__('report_trans.start_date')}}" required name="from"
                                    style="margin:0 10px">
                                
                                <input class="form-control range-to date-picker-default" 
                                    placeholder="{{__('report_trans.end_date')}}" type="text" required name="to"
                                    style="margin:0 10px">
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"
                        style="padding:5px 15px">{{trans('report_trans.submit')}}</button>
                </form>
                <br><br><hr><br>
                @if(isset($students_report))
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('student_trans.student_name')}}</th>
                            <th class="alert-success">{{ trans('student_trans.classroom') }}</th>
                            <th class="alert-success">{{trans('report_trans.date')}}</th>
                            <th class="alert-warning">{{trans('report_trans.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students_report as $student_report)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$student_report->name}}</td>          
                                <td>{{$student_report->classroom->name}}</td>
                                <td>{{$student_report->attendance->currentDate}}</td>
                                <td>

                                    @if($student_report->attendance->status == 0)
                                        <span class="btn-danger " style="padding:1px 15px;border-radius:5px;">{{trans('attendance_trans.absent')}}</span>
                                    @else
                                        <span class="btn-success"style="padding:1px 15px;border-radius:5px;">{{trans('attendance_trans.attendent')}}</span>
                                    @endif
                                </td>
                            </tr>
                        
                        @endforeach
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $('#report').attr('class','active_my');
</script>
@endsection