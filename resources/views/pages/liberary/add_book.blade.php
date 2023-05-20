@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('book_trans.add')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('book_trans.add')}}
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
                @if($errors->any())
                    <div class="alert alert-danger " role="alert">
                        <ul style='position:relative;'>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="position: absolute;left: 14px;top: 10px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('book_trans.title_ar')}}</label>
                                        <input type="text" name="title_ar" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{trans('book_trans.title_en')}}</label>
                                        <input type="text" name="title_en" class="form-control">
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade">{{trans('book_trans.choose.grade')}} : <span class="text-danger">*</span></label>
                                            <select id='grade' class="custom-select mr-sm-2" name="gradeID">
                                                <option selected disabled>{{trans('book_trans.choose.grade')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="class">{{trans('book_trans.choose.class')}} : <span class="text-danger">*</span></label>
                                            <select id='class' class="custom-select mr-sm-2 classesID" name="classID">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="teacher">{{trans('book_trans.choose.teacher')}} : <span class="text-danger">*</span></label>
                                            <select id='teacher' class="custom-select mr-sm-2 teacherID" name="teacherID">

                                            </select>
                                        </div>
                                    </div>


                                </div><br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label >{{trans('book_trans.attachment')}} : <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf" name="file_name" required>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"> {{trans('book_trans.create')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section("js")
    <script src="{{URL::asset('assets/js/custom/getClasses_ajax.js')}}"></script>
    <script src="{{URL::asset('assets/js/custom/getTeachers_ajax.js')}}"></script>
@endsection