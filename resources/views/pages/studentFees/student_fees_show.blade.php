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

            @if (session()->has('fail'))
              <div class="alert alert-danger">
                  {{session('fail')}}
              </div>
            @elseif(session()->has('success'))
              <div class="alert alert-success">
                  {{session('success')}}
              </div>
            @endif
           
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
                            <th>{{ trans('fee_trans.operation') }}</th>
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
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $studentFee->id }}" title="{{ trans('fee_trans.studentFeesUpdate') }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $studentFee->id }}" title="{{ trans('fee_trans.studentFeesDelete') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    
                                </td>
                            </tr>

                            <!-- delete_modal_graduate -->
                            <div class="modal fade" id="delete{{ $studentFee->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('fee_trans.studentFeesDelete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('student_fees.destroy',$studentFee->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('fee_trans.warning.delete') }}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        {{ trans('fee_trans.close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ trans('fee_trans.studentFeesDelete') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end delete modal-->
                            <!--start edit modal-->
                                <div class="modal fade" id="edit{{$studentFee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('fee_trans.studentFeesUpdate') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form method="post" action="{{ route('student_fees.update') }}">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <label for='credit' > {{__('fee_trans.credit') }}</label>
                                                            <input id='credit' type="number" name='credit' class='form-control' readonly
                                                                value="{{$studentFee->credit}}">
                                                            @error('credit')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col">
                                                            <label for='debit' > {{__('fee_trans.debit') }}</label>
                                                            <input id='debit' type="number" name='debit' class='form-control'
                                                                value="{{$studentFee->debit}}">>
                                                            @error('debit')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <input type="hidden" name='studentFeesID' value="{{$studentFee->id}}">
                                                    </div>
                                                    <br>

                                                    <button type="submit" class="btn btn-primary">{{trans('fee_trans.update')}}</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            <!--end edit modal-->
                           
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
<script>
    $('#study_fee').attr('class','active_my');
</script>
@endsection
