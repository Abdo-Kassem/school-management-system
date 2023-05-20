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
                                    
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('quizz_trans.question')}}</th> 
                                            <th scope="col">{{trans('quizz_trans.answer')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td style="padding:10px">
                                                    <span style="color:brown;padding-bottom:10px;display:inline-block">{{$question->title}}</span>
                                                    <?php $questionAnswers = explode(PHP_EOL,$question->answers);?>
                                                    <div class='form-check'>
                                                    @foreach($questionAnswers as $answer)
                                                        <div style="margin:0 10px; display:inline-block">
                                                            @if($question->studentAnswer == $answer && $question->studentAnswer == $question->answer)
                                                                <span class="bg-success text-white" style="padding: 4px 10px;border-radius: 10px;">{{$answer}}</span>
                                                            @elseif($question->studentAnswer == $answer && $question->studentAnswer != $question->answer)
                                                                <span class="bg-danger text-white" style="padding: 4px 10px;border-radius: 10px;">{{$answer}}</span>
                                                            @else
                                                                <span>{{$answer}}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </td>
                                                <td>{{$question->answer}} </td>
                                                
                                            </tr>

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