@extends('layouts.master')
    
@section('title')
    قائمة الاسئلة
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
                                <div class="table-responsive">
                                    <form action="{{route('student.quizz.answer',['quizzName'=>$quizzName,'quizzID'=>$quizzID])}}" method="post">
                                        @csrf
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('quizz_trans.question')}}</th> 
                                                <th scope="col">{{trans('quizz_trans.score')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($questions as $question)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td style="padding:10px">
                                                        <span style="color:brown;padding-bottom:10px;display:inline-block">{{$question->title}}</span>
                                                        <?php $answers = explode(PHP_EOL,$question->answers); $count=0;?>
                                                        <div class='form-check'>
                                                        @foreach($answers as $answer)
                                                            <div style="margin:0 10px; display:inline-block">
                                                                <input id='{{$answer}}' type="radio" name='answer[{{$question->id}}]' value="{{$count}}" required>
                                                                <label class='form-check-label' for="{{$answer}}">{{$answer}}</label>
                                                            </div>
                                                            <?php $count++;?>
                                                        @endforeach
                                                        </div>
                                                    </td>
                                                    <td>{{$question->score}}</td>
                                                    
                                                </tr>

                                            @endforeach
                                        </table>
                                        <input type="submit" value="{{__('student_trans.send')}}" class="btn btn-primary">
                                    </form>
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