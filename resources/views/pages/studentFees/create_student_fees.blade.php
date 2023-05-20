@extends('layouts.master')

@section('title')
    {{ trans('fee_trans.student_title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('fee_trans.student_title_page') }}
@stops
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
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

                <form method="post" action="{{ route('student_fees.store') }}">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col">
                            <label for='name' > {{__('fee_trans.studentName')}} </label>
                            <input class="form-control" type="text" value="{{$student->name}}" id='name' 
                                readonly value="{{$student->name}}">
                        </div>

                        <div class="form-group col">
                            <label for='type' > {{__('fee_trans.type')}} </label>
                            <select class="form-control p-2" name='type' id='type' url="{{route('student-fees.fees_value')}}">
                                <option selected disabled>{{trans('fee_trans.select')}}</option>
                                <option value="1">{{trans('fee_trans.study.fees')}}</option>
                                <option value="2">{{trans('fee_trans.bus.fees')}}</option>
                            </select>
                            @error('type')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <input type="hidden" name='studentID' value="{{$student->id}}">
                        <input type="hidden" name='studyFeesID' >

                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for='credit' > {{__('fee_trans.credit') }}</label>
                            <input id='credit' type="number" name='credit' class='form-control' readonly>
                            @error('credit')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for='debit' > {{__('fee_trans.debit') }}</label>
                            <input id='debit' type="number" name='debit' class='form-control'>
                            @error('debit')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('fee_trans.create')}}</button>

                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript" src="{{URL::asset('assets\js\custom\getCredit_ajax.js')}}"></script>

@endsection
