@extends('layouts.master')

@section('title')
    {{ trans('student_trans.title_page_answer') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('student_trans.title_page_answer') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">  
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('student_trans.student_name') }}</th>
                            <th>{{ trans('student_trans.acadimy_year') }}</th>
                            <th>{{ trans('student_trans.classroom') }}</th>
                            <th>{{ trans('student_trans.grades') }}</th>
                            <th>{{ trans('quizz_trans.quizzGrades') }}</th>
                            <th>{{ trans('student_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($answers as $answer)
                            
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $answer->student->name }}</td>    
                                <td>{{ $answer->student->academic_year }}</td> 
                                <td>{{ $answer->student->classroom->name }}</td>
                                <td>{{ $answer->grades }}</td>
                                <td>{{ $quizzScore }}</td>
                                <td>    
                                    <a class="btn btn-primary" href="{{route('quizz.student.answer',['quizzID'=>$answer->quizzID,'studentID'=>$answer->studentID])}}">
                                        <i class="fa fa-eye" style='color:white;margin:2px'></i>
                                        {{ trans('student_trans.show_answer') }}
                                    </a>
                                </td>
                            </tr>

                           
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<!-- row closed -->
@endsection
