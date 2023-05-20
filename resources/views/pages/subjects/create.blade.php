@extends('layouts.master')
@section('css')
  
@section('title')
    {{trans('subject_trans.title_page')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('subject_trans.title_page')}}
@stop
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
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('subject.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('subject_trans.name_ar')}}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                        @error('name_ar')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('subject_trans.name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control">
                                        @error('name_en')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('subject_trans.grade')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gradeID">
                                            <option selected disabled>{{trans('subject_trans.choose.grade')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('gradeID')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{trans('subject_trans.class')}}</label>
                                        <select name="classID" class="custom-select classesID"></select>
                                        @error('classID')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{trans('subject_trans.teacherName')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacherID">
                                            <option selected disabled>{{trans('subject_trans.choose.teacher')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('teacherID')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('subject_trans.create')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/js/custom/getClasses_ajax.js')}}"></script>
@endsection