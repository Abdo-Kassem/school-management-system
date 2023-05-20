@extends('layouts.master')

@section('title')
    {{ trans('fee_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('fee_trans.title_page') }}
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
            
            <a href="{{route('fees.create')}}" class="btn btn-success" style='padding:5px 20px;text-transform:capitalize'>
                {{ __('fee_trans.add_fees') }}
            </a>

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('fee_trans.name') }}</th>
                            <th>{{ trans('fee_trans.type') }}</th>
                            <th>{{ trans('fee_trans.grade') }}</th>
                            <th>{{ trans('fee_trans.class') }}</th>
                            <th>{{ trans('fee_trans.notes') }}</th>
                            <th>{{ trans('fee_trans.cost') }}</th>
                            <th>{{ trans('fee_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($fees as $fee)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $fee->name }}</td>
                                <td><?php echo $fee->type===1?trans('fee_trans.study.fees'):trans('fee_trans.bus.fees') ?></td>
                                <td>{{ $fee->grade->name }}</td>
                                <td>{{ $fee->class->name }}</td>
                                <td>{{ $fee->notes }}</td>
                                <td>{{ $fee->value }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $fee->id }}" title="{{ trans('fee_trans.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $fee->id }}" title="{{ trans('fee_trans.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="{{route('fees.show',$fee->id)}}" class="btn btn-danger btn-sm"  title="{{ trans('fee_trans.show') }}">
                                        <i class="fa fa-eye" style='color:white'></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- delete_modal_graduate -->
                            <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('fee_trans.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('fees.destroy',$fee->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('fee_trans.warning.delete') }}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        {{ trans('fee_trans.close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ trans('fee_trans.delete') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end delete modal-->
                            <!--start edit modal-->
                                <div class="modal fade" id="edit{{$fee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('fee_trans.edit') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('fees.update')}}" method="post">
                                                    @csrf
                                                    <div class="form-row">

                                                        <div class="form-group col">
                                                            <label for='name_ar' > {{__('fee_trans.name_ar')}} </label>
                                                            <input class="form-control" type="text" name='name_ar' id='name_ar'
                                                                value="{{$fee->getTranslation('name','ar')}}">
                                                            @error('name_ar')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col">
                                                            <label for='name_en' > {{__('fee_trans.name_en')}} </label>
                                                            <input class="form-control" type="text" name='name_en' id='name_en'
                                                                value="{{$fee->getTranslation('name','en')}}">
                                                            @error('name_en')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col">
                                                            <label for='type' > {{__('fee_trans.type')}} </label>
                                                            <select class="form-control p-2" name='type' id='type'>
                                                                <option value="1" <?php if($fee->type === 1) echo'selected';?>>
                                                                    {{trans('fee_trans.study.fees')}}
                                                                </option>
                                                                <option value="2" <?php if($fee->type === 2) echo'selected';?>>
                                                                    {{trans('fee_trans.bus.fees')}}
                                                                </option>
                                                            </select>
                                                            @error('type')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <input type="hidden" value="{{$fee->id}}" name="feesID">

                                                    </div>
                                                    <br>
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <label for="grade">{{trans('fee_trans.grade')}}</label>
                                                            <select class="form-control p-2 " name="gradeID" required id='grade'>
                                                                <option selected disabled >{{$fee->grade->name}}</option>
                                                            </select>
                                                            @error('gradeID')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col">
                                                            <label for="class">{{trans('fee_trans.class')}} : <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control p-2 classesID" name="classID" required id='class'>
                                                                <option selected disabled >{{$fee->class->name}}</option>
                                                            </select>
                                                            @error('classID')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-row">

                                                        <div class="form-group col">
                                                            <label for='acadimic_year' >{{ __('fee_trans.acadimic.year') }}</label>
                                                            <select name='acadimic_year' class='form-control p-2' id='acadimic_year'>
                                                                <option value="{{date('Y')}}" <?php if($fee->acadimic_year == date('Y')) echo'selected';?>>
                                                                    {{date('Y')}}
                                                                </option>
                                                                <option value="{{date('Y')+1}}" <?php if($fee->acadimic_year == date('Y')+1) echo'selected';?>>
                                                                    {{date('Y')+1}}
                                                                </option>
                                                            </select>
                                                            @error('acadimic_year')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col">
                                                            <label for='cost' > {{__('fee_trans.cost') }}</label>
                                                            <input id='cost' type="text" name='cost' class='form-control' value="{{$fee->value}}">
                                                            @error('cost')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="form-row">

                                                        <div class="form-group col">
                                                            <label for='notes' > {{__('fee_trans.notes') }}</label>
                                                            <textarea id='notes' type="text" name='notes' class='form-control'>
                                                                {{$fee->notes}}
                                                            </textarea>
                                                        </div>
                                                        @error('notes')
                                                        <span class="form-text text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>

                                                    <button type="submit" class="btn btn-primary">{{trans('fee_trans.edit')}}</button>
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
