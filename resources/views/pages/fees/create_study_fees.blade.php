@extends('layouts.master')

@section('title')
    {{ trans('fee_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('fee_trans.title_page') }}
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

                <form method="post" action="{{ route('fees.store') }}">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col">
                            <label for='name_ar' > {{__('fee_trans.name_ar')}} </label>
                            <input class="form-control" type="text" name='name_ar' id='name_ar'>
                            @error('name_ar')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for='name_en' > {{__('fee_trans.name_en')}} </label>
                            <input class="form-control" type="text" name='name_en' id='name_en'>
                            @error('name_en')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for='type' > {{__('fee_trans.type')}} </label>
                            <select class="form-control p-2" name='type' id='type'>
                                <option value="1">{{trans('fee_trans.study.fees')}}</option>
                                <option value="2">{{trans('fee_trans.bus.fees')}}</option>
                            </select>
                            @error('type')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="grade">{{trans('fee_trans.grade')}}</label>
                            <select class="form-control p-2 " name="gradeID" required id='grade'>
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach
                            </select>
                            @error('gradeID')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="class">{{trans('fee_trans.class')}} : <span
                                    class="text-danger">*</span></label>
                            <select class="form-control p-2 classesID" name="classID" required id='class'>

                            </select>
                            @error('classID')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">

                        <div class="form-group col">
                            <label for='acadimic_year' >{{ __('fee_trans.acadimic.year') }}</label>
                            <select name='acadimic_year' class='form-control p-2' id='acadimic_year'>
                                <option value="{{date('Y')}}">{{date('Y')}}</option>
                                <option value="{{date('Y')+1}}">{{date('Y')+1}}</option>
                            </select>
                            @error('acadimic_year')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for='cost' > {{__('fee_trans.cost') }}</label>
                            <input id='cost' type="text" name='cost' class='form-control' >
                            @error('cost')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <br>
                    <div class="form-row">

                        <div class="form-group col">
                            <label for='notes' > {{__('fee_trans.notes') }}</label>
                            <textarea id='notes' type="text" name='notes' class='form-control'></textarea>
                        </div>
                        @error('nores')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror

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
<script type="text/javascript" src="{{URL::asset('assets\js\custom\getClasses_ajax.js')}}"></script>

@endsection
