@extends('layouts.master')

@section('title')
    {{__('classroom_trans.title_page')}}
@endsection

@section('page-header')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{__('classroom_trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="default-color">{{__('breadcrump_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('classroom_trans.title_page')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
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
                <div class='border-bottom border-light mb-3 p-3'>
                    <button class='btn btn-success' data-toggle="modal" data-target="#addClassroom"
                            style="text-transform:capitalize">
                        {{__('classroom_trans.add_classroom')}}
                    </button>
                </div>

                <div id="accordion">
                @foreach($grades as $grade)
                    <div class="card">
                        <div class="card-header" id="heading{{$grade->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link w-100" data-toggle="collapse" data-target="#classroom{{$grade->id}}" aria-expanded="true">
                                    {{$grade->name}}
                                </button>
                            </h5>
                        </div>

                        <div id="classroom{{$grade->id}}" class="collapse" aria-labelledby="heading{{$grade->id}}" data-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('classroom_trans.classroomName') }}</th>
                                                <th>{{ trans('classroom_trans.status') }}</th>
                                                <th>{{ trans('classroom_trans.className') }}</th>
                                                <th>{{ trans('classroom_trans.teacherName') }}</th>
                                                <th>{{ trans('classes_trans.operations') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>

                                            @foreach ($grade->classeRooms as $classroom)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $classroom->name }}</td>
                                                <td>
                                                    <?php
                                                        if($classroom->status) 
                                                            echo __('classroom_trans.statusOn');
                                                        else
                                                            echo __('classroom_trans.statusOff');
                                                    ?>
                                                </td>
                                                <td>{{ $classroom->classe->name }}</td>
                                                <td>
                                                    <select class="form-control p-1">
                                                        @foreach($classroom->teachers as $teacher)
                                                        <option>{{$teacher->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#edit{{$classroom->id}}"
                                                        title="{{ trans('classroom_trans.save') }}"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete{{$classroom->id}}"
                                                        title="{{ trans('classroom_trans.delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                             </tr>
                                                 <!-- edit- modal-->
                                                <div class="modal fade" id="edit{{$classroom->id}}" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('classroom_trans.edit_classroom_header') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- edit_form -->
                                                                <form action="{{ route('classroom.update') }}" method="post">
                                                                    {{ method_field('patch') }}
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                    class="mr-sm-2">{{ trans('classroom_trans.classroom_name_ar') }}
                                                                                :</label>
                                                                            <input id="Name" type="text" name="name_ar"
                                                                                    class="form-control"
                                                                                    value="{{ $classroom->getTranslation('name','ar')}}"
                                                                                    >
                                                                            <input  type="hidden" name="id" class="form-control"
                                                                                    value="{{ $classroom->id }}">
                                                                        
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                    class="mr-sm-2">{{ trans('classroom_trans.classroom_name_en') }}
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                    value="{{ $classroom->getTranslation('name', 'en') }}"
                                                                                    name="name_en" >
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="grade">{{ trans('classroom_trans.grade_name_choice') }}
                                                                            :</label>
                                                                        <select class="form-control form-control-lg p-2"
                                                                                id="grade" name="gradeID">
                                                
                                                                            @foreach ($gradesToAddClassroom as $grad)
                                                                                <option value="{{ $grad->id }}" 
                                                                                    <?php
                                                                                        if($grad->id === $grade->id)
                                                                                            echo 'selected';
                                                                                        
                                                                                    ?>>
                                                                                    {{ $grad->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="edit-class">{{ trans('classroom_trans.classes_name_choice') }}
                                                                            :</label>
                                                                        <select class="form-control form-control-lg p-2 classesID"
                                                                                id="edit-class" name="classID">
                                                                                <option value="{{ $classroom->classe->id }}" selected>
                                                                                    {{ $classroom->classe->name }}
                                                                                </option>
                                                                        </select>

                                                                    </div>

                                                                    <div class="col-md-6 col-sm-12 pt-3">
                                                                        <label for="teacher"
                                                                            class="mr-sm-2">{{ trans('classroom_trans.teacher_choice') }}
                                                                            :</label>

                                                                        <div class="box">
                                                                            <select class="p-2 form-control" name="teacherID[]" id='teacher' multiple size='2' title='ctr+click to multiple'>
                                        
                                                                                <option value="0" disabled >{{ trans('classroom_trans.teacher_choice') }}</option>
                                                                            
                                                                                @foreach($classroom->teachers as $teacher)
                                                                                    <option value="{{$teacher->id}}" selected>{{$teacher->name}}</option>
                                                                                @endforeach
                                                                                <option value="0" disabled >------------------------------</option>
                                                                                @foreach($teachers as $teacher)
                                                                                    <?php $status = false;?>
                                                                                    @foreach($classroom->teachers as $teachr)
                                                                                        @if($teacher->id === $teachr->id)
                                                                                            <?php $status = true; ?>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @if(!$status)
                                                                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                                
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                    <div class="form-check">
                                                                        <input id='status' type="checkbox" class="form-check-input" name='status'
                                                                            <?php if($classroom->status) echo 'checked'?>
                                                                        >
                                                                        <label class='form-check-label' for='status'>{{__('classroom_trans.status')}}</label>
                                                                    </div>

                                                                    <br><br>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ trans('classroom_trans.close') }}</button>
                                                                        <button type="submit"
                                                                                class="btn btn-success">{{ trans('classroom_trans.save') }}</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end edit modal-->

                                                <!--start delete modal -->                      
                                                <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('classroom_trans.delete_classroom_header') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('classroom.destroy',$classroom->id) }}"
                                                                    method="post">
                                                                    {{ method_field('delete') }}
                                                                    @csrf
                                                                    {{ trans('classroom_trans.warning_classroom_delete') }}
                                                                    
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ trans('classroom_trans.close') }}</button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger">{{ trans('classroom_trans.delete') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- end delete modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>   

        </div>
    </div>
</div>

<!-- add modal-->
<div class="modal fade" id="addClassroom" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classroom_trans.addition_header') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{route('classroom.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                       
                            <div class="row">

                                <div class="col-md-6 col-sm-12 pt-3">
                                    <label for="name_ar"
                                        class="mr-sm-2">{{ trans('classroom_trans.name_ar') }}
                                        :</label>
                                    <input class="form-control" type="text" name="name_ar" id='name_ar'/>
                                </div>


                                <div class="col-md-6 col-sm-12 pt-3">
                                    <label for="name_en"
                                        class="mr-sm-2">{{ trans('classroom_trans.name_en') }}
                                        :</label>
                                    <input class="form-control" type="text" name="name_en" />
                                </div>


                                <div class="col-md-6 col-sm-12 pt-3">
                                    <label for="grade_name"
                                        class="mr-sm-2">{{ trans('classroom_trans.grade_name_choice') }}
                                        :</label>

                                    <div class="box">
                                        <select class="p-2 form-control" name="gradeID" id='grade_name'>
                                        <option value="0" disabled selected>choose grade</option>
                                        @foreach($gradesToAddClassroom as $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12 pt-3">
                                    <label for="classes_name"
                                        class="mr-sm-2">{{ trans('classroom_trans.classes_name_choice') }}
                                        :</label>

                                    <div class="box">
                                        <select class="p-2 form-control classesID" name="classesID" id='classes_name'>
    
                                            <option value="0" disabled selected>{{ trans('classroom_trans.classes_name_choice') }}</option>
                                            @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12 pt-3">
                                    <label for="teacher"
                                        class="mr-sm-2">{{ trans('classroom_trans.teacher_choice') }}
                                        :</label>

                                    <div class="box">
                                        <select class="p-2 form-control" name="teacherID[]" id='teacher' multiple size='2' title='ctr+click to multiple'>
    
                                            <option value="0" disabled selected>{{ trans('classroom_trans.teacher_choice') }}</option>
                                            @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12 pt-3">

                                    <div class="form-check bg-light" style="padding:10px 20px;">
                                        <input type="checkbox" class="form-check-input" id="status" name='status'>
                                        <label class="form-check-label" for="status">{{trans('classroom_trans.status')}}</label>
                                    </div>

                                </div>

                            </div>
                                

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('classroom_trans.close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('classroom_trans.create') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>

<!-- row closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/js/custom/getClasses_ajax.js')}}"></script>
<script>
    $('#classroom').attr('class','active_my');
</script>
@endsection
