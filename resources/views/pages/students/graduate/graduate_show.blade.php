@extends('layouts.master')

@section('title')
    {{ trans('graduate_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('graduate_trans.title_page') }}
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
            
            <button href="#add_graduate" class="btn btn-success"  data-toggle="modal"
                    style="padding:5px 20px;text-transform:capitalize">    
                {{ __('graduate_trans.add_graduate') }}
            </button>

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('graduate_trans.studentName') }}</th>
                            <th>{{ trans('graduate_trans.email') }}</th>
                            <th>{{ trans('graduate_trans.grade') }}</th>
                            <th>{{ trans('graduate_trans.class') }}</th>
                            <th>{{ trans('graduate_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($graduates as $graduate)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $graduate->name }}</td>
                                <td>{{ $graduate->email }}</td>
                                <td>{{ $graduate->grade->name }}</td>
                                <td>{{ $graduate->class->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $graduate->id }}">{{ trans('graduate_trans.back') }}
                                    </button>
                                </td>
                            </tr>

                            <!-- delete_modal_graduate -->
                            <div class="modal fade" id="delete{{ $graduate->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('graduate_trans.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('graduate.destroy') }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('graduate_trans.warning.delete') }}
                                                <input type="hidden" name='graduateID' value="{{$graduate->id}}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('graduate_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('graduate_trans.delete') }}</button>
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

<!-- add_modal_teacher -->
<div class="modal fade" id="add_graduate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('graduate_trans.add_graduate') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{route('graduate.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('promotion_trans.gradeFrom')}}</label>
                                <select class="custom-select mr-sm-2 " name="gradeID" required>
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('promotion_trans.classFrom')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 classesID" name="classID" required>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('teacher_trans.close') }}
                            </button>
                            <button type="submit" name='create'
                                class="btn btn-success">{{ trans('teacher_trans.create') }}
                            </button>
                        </div>


                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
<!-- end add modal-->

</div>
<!-- row closed -->
@endsection
@section('js')

<script type="text/javascript" src="{{URL::asset('assets\js\custom\getClasses_ajax.js')}}"></script>
<script>
    $('#student').attr('class','active_my');
</script>
@endsection
