@extends('layouts.master')

@section('title')
    {{ trans('promotion_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('promotion_trans.title_page') }}
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
                
                <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6><br>

                <form method="post" action="{{ route('promotion.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{trans('promotion_trans.gradeFrom')}}</label>
                            <select class="custom-select mr-sm-2 " name="gradeID" required>
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{trans('promotion_trans.classFrom')}} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2 classesID" name="classID" required>

                            </select>
                        </div>
                    </div>
                    <br>
                    <h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6><br>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{trans('promotion_trans.gradeTo')}}</label>
                            <select class="custom-select mr-sm-2" name="gradeID_new" >
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{trans('promotion_trans.classTo')}}: <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2 classesID_new" name="classID_new" >

                            </select>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('promotion_trans.create')}}</button>
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
