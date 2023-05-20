@extends('layouts.master')

@section('title')
    {{trans('quizz_trans.title_page')}}
@endsection

    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('quizz_trans.title_page')}}
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('quizz_trans.name')}}</th>
                                            <th>{{trans('quizz_trans.class')}}</th>
                                            <th>{{trans('quizz_trans.classroom')}}</th>
                                            <th>{{trans('quizz_trans.subject')}}</th>
                                            <th>{{trans('quizz_trans.teacherName')}}</th> 
                                            <th>{{trans('quizz_trans.grades')}}</th>
                                            <th>{{trans('quizz_trans.operationOrScore')}}</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizz)
                                            @if($quizz->exist){{--exist => has answer of current student--}}
                                            <tr style="background-color:whitesmoke;">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$quizz->name}}</td>
                                            <td>{{$quizz->class->name}}</td>
                                            <td>{{$quizz->classroom->name}}</td>
                                            <td>{{$quizz->subject->name}}</td>
                                            <td>{{$quizz->teacher->name}}</td>
                                            <td>{{$quizz->grades}}</td>
                                            <td>{{$quizz->studentGrades}}</td>
                                            @else
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$quizz->name}}</td>
                                            <td>{{$quizz->class->name}}</td>
                                            <td>{{$quizz->classroom->name}}</td>
                                            <td>{{$quizz->subject->name}}</td>
                                            <td>{{$quizz->teacher->name}}</td>
                                            <td>{{$quizz->grades}}</td>
                                                <td>
                                                    <a href="{{route('student.questions.index',['quizzName'=>$quizz->getTranslation('name','en'),'quizzID'=>$quizz->id])}}" class="btn btn-primary btn-sm"  title="{{trans('quizz_trans.show')}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif

                                        @endforeach
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


