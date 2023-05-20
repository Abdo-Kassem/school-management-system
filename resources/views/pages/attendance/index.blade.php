@extends('layouts.master')
@section('css')
   
@section('title')
    {{__('attendance_trans.title_page')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{__('attendance_trans.title_page')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <h5 style="font-family: 'Cairo', sans-serif;color: red;padding:10px"> {{__('attendance_trans.date')}} {{ date('Y/m/d') }}</h5>
    <form method="post" action="{{ route('attendance.store') }}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('student_trans.student_name') }}</th>
                <th class="alert-success">{{ trans('student_trans.email') }}</th>
                <th class="alert-success">{{ trans('student_trans.grade') }}</th>
                <th class="alert-success">{{ trans('student_trans.class') }}</th>
                <th class="alert-success">{{ trans('student_trans.classroom') }}</th>
                <th class="alert-success">{{ trans('student_trans.operation') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->grade->name }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>{{ $student->classroom->name }}</td>
                    <td>

                        @if(isset($student->attendance()->where('currentDate',date('Y-m-d'))->first()->id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="status[{{$student->id}}]" 
                                       <?php echo $student->attendance()->where('currentDate',date('Y-m-d'))->first()->status == 1 ? 'checked' : '' ?>
                                       class="leading-tight" type="radio" value="1">
                                <span class="text-success">{{__('attendance_trans.attendent')}}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="status[{{$student->id}}]" 
                                        <?php echo $student->attendance()->where('currentDate',date('Y-m-d'))->first()->status == 0 ? 'checked' : '' ?>
                                       class="leading-tight" type="radio" value="0">
                                <span class="text-danger">{{__('attendance_trans.absent')}}</span>
                            </label>
                            <input type="hidden" name='attendancID[{{$student->id}}]' value='{{$attendance->id}}'>

                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="status[{{$student->id}}]" class="leading-tight" type="radio"
                                       value="1" required>
                                <span class="text-success">{{__('attendance_trans.attendent')}}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="status[{{$student->id}}]" class="leading-tight" type="radio"
                                       value="0"  required>
                                <span class="text-danger">{{__('attendance_trans.absent')}}</span>
                            </label>
                            <input type="hidden" name='attendancID[{{$student->id}}]' value='-1'>

                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($students->count() > 0)
        <P>
            <button class="btn btn-success" type="submit">{{ trans('attendance_trans.save') }}</button>
        </P>
        @endif
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
<script>
    $('#attendance').attr('class','active_my');
</script>
@endsection