@extends('layouts.master')

@section('title')
    {{ trans('student_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('student_trans.title_page') }}
@stop
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('student_trans.student_name') }}</th>
                            <th>{{ trans('student_trans.email') }}</th>
                            <th>{{ trans('student_trans.gender') }}</th>
                            <th>{{ trans('student_trans.acadimy_year') }}</th>
                            <th>{{ trans('student_trans.birth.date') }}</th>
                            <th>{{ trans('student_trans.address') }}</th>
                            <th>{{ trans('student_trans.religion') }}</th>
                            <th>{{ trans('student_trans.grade') }}</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($students as $arrayOfStudent)
                            @foreach($arrayOfStudent as $student)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td><?php echo trans('student_trans.gender_'.$student->gender) ?></td>
                                <td>{{ $student->academic_year }}</td>
                                <td>{{ $student->birth_date }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->religion->name }}</td>
                                <td>{{ $student->grade->name }}</td>
                               
                            </tr>

                            @endforeach
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


</div>
<!-- row closed -->
@endsection
@section('js')

<script type="text/javascript" src="{{URL::asset('assets\js\custom\getClasses_ajax.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets\js\custom\getClassroom_ajax.js')}}"></script>
<script>
    $('#student').attr('class','active_my');
</script>
@endsection