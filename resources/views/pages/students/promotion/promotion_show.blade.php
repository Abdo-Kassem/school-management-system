@extends('layouts.master')

@section('title')
    {{ trans('promotion_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('promotion_trans.title_page') }}
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
            
            <a href="{{route('promotion.create')}}" class="btn btn-success" style='padding:5px 20px;text-transform:capitalize'>
                {{ __('promotion_trans.add_promotion') }}
            </a>

            <button class="btn btn-danger rollback" style='padding:5px 20px;text-transform:capitalize' data-toggle="modal" data-target="#deleteAll">
                {{trans('promotion_trans.back')}}
            </button>
            @include('pages.students.promotion.deleteAllModal')

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input type='checkbox' name='checkedAll' class='check_all'></th>
                            <th>#</th>
                            <th>{{ trans('promotion_trans.gradeFrom') }}</th>
                            <th>{{ trans('promotion_trans.classFrom') }}</th>
                            <th>{{ trans('promotion_trans.gradeTo') }}</th>
                            <th>{{ trans('promotion_trans.classTo') }}</th>
                            <th>{{ trans('promotion_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($promotions as $promotion)
                            <tr>
                                <?php $i++; ?>
                                <td><input type='checkbox' value="{{$promotion->id}}" class='promotion_checked'></td>
                                <td>{{ $i }}</td>
                                <td>{{ $promotion->gradeFrom->name }}</td>
                                <td>{{ $promotion->ClassFrom->name }}</td>
                                <td>{{ $promotion->gradeTo->name }}</td>
                                <td>{{ $promotion->classTo->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $promotion->id }}">{{ trans('promotion_trans.back.one') }}
                                    </button>
                                    <a href="{{route('promotion.show',$promotion->id)}}" class="btn btn-warning btn-sm"
                                        title="{{ trans('promotion_trans.show') }}"><i class="fa fa-eye" style='color:white'></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- delete_modal_promotion -->
                            <div class="modal fade" id="delete{{ $promotion->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('promotion_trans.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('promotion.destroy') }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('promotion_trans.warning.delete') }}
                                                <input type="hidden" name='promotionID' value="{{$promotion->id}}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('promotion_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('promotion_trans.delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
@toastr_js
@toastr_render

<script type="text/javascript" src="{{URL::asset('assets\js\custom\checkBox.js')}}"></script>
<script>
    $('#student').attr('class','active_my');
</script>
@endsection
