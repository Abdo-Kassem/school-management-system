@extends('layouts.master')
@section('css')
  
@section('title')
    {{trans('quizz_trans.title_page')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('quizz_trans.choose.grade')}}
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
                            <form action="{{route('quizz.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('quizz_trans.name_ar')}}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                        @error('name_ar')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="title"> {{trans('quizz_trans.name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control">
                                        @error('name_en')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="grades"> {{trans('quizz_trans.grades')}}</label>
                                        <input type="number" name="grades" class="form-control" id="grades">
                                        @error('grades')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id"> {{trans('quizz_trans.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" quizz=true name="gradeID">
                                                <option selected disabled> {{trans('quizz_trans.choose.grade')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('gradeID')
                                            <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('quizz_trans.choose.class')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2 classesID" name="classID">

                                            </select>
                                            @error('classID')
                                            <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('quizz_trans.choose.classroom')}} : </label>
                                            <select class="custom-select mr-sm-2 classroomID" name="classroomID">

                                            </select>
                                            @error('classroomID')
                                            <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subject">{{trans('quizz_trans.subject')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subjectID" id='subject'>
                                                <option selected disabled>{{trans('quizz_trans.choose.subject')}}...</option>
                                                @foreach($subjects as $subject)
                                                    <option  value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subjectID')
                                            <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="teacher_id">{{trans('quizz_trans.teacherName')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2 teacherID" name="teacherID">
                                                <option selected disabled> {{trans('quizz_trans.choose.teacher')}}...</option>
                                                
                                            </select>
                                            @error('teacherID')
                                            <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('quizz_trans.add')}}</button>
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
    <script src="{{URL::asset('assets/js/custom/getClassroom_ajax.js')}}"></script>
    <script src="{{URL::asset('assets/js/custom/getTeachers_ajax.js')}}"></script>
@endsection