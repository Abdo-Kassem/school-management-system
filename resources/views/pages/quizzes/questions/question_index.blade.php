@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة الاسئلة
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الاسئلة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
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
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_question">
                                    <i class="fa fa-plus"></i> {{trans('quizz_trans.add_question')}}
                                </button><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('quizz_trans.question')}}</th>
                                            <th scope="col">{{trans('quizz_trans.answers')}}</th>
                                            <th scope="col">{{trans('quizz_trans.answer')}}</th>
                                            <th scope="col">{{trans('quizz_trans.score')}}</th>
                                            <th scope="col">{{trans('quizz_trans.operation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#edit_question{{ $question->id }}"
                                                        title="{{trans('quizz_trans.edit_question')}}">
                                                    <i class="fa fa-edit"></i> 
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_question{{ $question->id }}" title="{{trans('quizz_trans.delete_question')}}"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                                </td>
                                            </tr>

                                        @include('pages.quizzes.questions.destroy')
                                        @include('pages.quizzes.questions.edit')
                                        @endforeach
                                    </table>
                                    @include('pages.quizzes.questions.add')
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