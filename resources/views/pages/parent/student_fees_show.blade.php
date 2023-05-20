@extends('layouts.master')

@section('title')
    {{ trans('fee_trans.student_title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('fee_trans.student_title_page') }}
@stops
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
                            <th>{{ trans('fee_trans.studentName') }}</th>
                            <th>{{ trans('fee_trans.acadimic.year') }}</th>
                            <th>{{ trans('fee_trans.grade') }}</th>
                            <th>{{ trans('fee_trans.class') }}</th>
                            <th>{{ trans('fee_trans.type') }}</th>
                            <th>{{ trans('fee_trans.credit') }}</th>
                            <th>{{ trans('fee_trans.debit') }}</th>
                            <th>{{ trans('fee_trans.remaining') }}</th>
                            <th>{{ trans('fee_trans.adding.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($studentFees as $studentFee)
                            <tr>
                                <td>{{ $studentFee->student->name }}</td>
                                <td>{{ $studentFee->student->academic_year }}</td>
                                <td>{{ $studentFee->student->grade->name }}</td>
                                <td>{{ $studentFee->student->class->name }}</td>
                                <td><?php echo $studentFee->studyFees->type===1?trans('fee_trans.study.fees'):trans('fee_trans.bus.fees') ?></td>
                                <td>{{ $studentFee->credit }}</td>
                                <td>{{ $studentFee->debit }}</td>
                                <td>{{ $studentFee->credit-$studentFee->debit }}.00</td>
                                <td>{{ $studentFee->created_at }}</td>
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

