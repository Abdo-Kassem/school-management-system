@extends('layouts.master')

@section('title')
    {{trans('subject_trans.title_page')}}
@endsection

    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('subject_trans.title_page')}}
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
                            @if (session()->has('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                            @elseif(session()->has('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger " role="alert">
                                    <ul style='position:relative;'>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="position: absolute;left: 14px;top: 10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                                <a href="{{route('subject.create')}}" class="btn btn-success btn-md" role="button"
                                   aria-pressed="true" style="text-transform:capitalize">
                                   {{trans('subject_trans.add')}}
                                </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('subject_trans.name')}}</th>
                                            <th>{{trans('subject_trans.grade')}} </th>
                                            <th>{{trans('subject_trans.class')}}</th>
                                            <th>{{trans('subject_trans.teacherName')}}</th>
                                            <th>{{trans('subject_trans.operation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grade->name}}</td>
                                            <td>{{$subject->class->name}}</td>
                                            <td>{{$subject->teacher->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}" title="{{trans('subject_trans.delete')}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#edit{{ $subject->id }}" title="{{trans('subject_trans.edit')}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!--start delete modal -->
                                            <div class="modal fade" id="delete_subject{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('subject.destroy',$subject->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('subject_trans.delete')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{trans('subject_trans.warning.delete')}} {{$subject->name}}</p>
                                                            <input type="hidden" name="id"  value="{{$subject->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{trans('subject_trans.close')}}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{trans('subject_trans.delete')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end delete modal-->
                                            <!--start edit modal-->
                                            <div class="modal fade " id="edit{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('subject_trans.edit')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('subject.update')}}" method="post">
                                                                {{csrf_field()}}

                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="title">{{trans('subject_trans.name_ar')}}</label>
                                                                        <input type="text" name="name_ar"
                                                                            value="{{ $subject->getTranslation('name', 'ar') }}"
                                                                            class="form-control"
                                                                        >
                                                                        <input type="hidden" name="id" value="{{$subject->id}}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="title">{{trans('subject_trans.name_en')}}</label>
                                                                        <input type="text" name="name_en"
                                                                            value="{{ $subject->getTranslation('name', 'en') }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <div class="form-row">
                                                                    <div class="form-group col">
                                                                        <label for="inputState">{{trans('subject_trans.grade')}}</label>
                                                                        <select class="custom-select my-1 mr-sm-2" name="gradeID">
                                                                            <option selected disabled>{{trans('subject_trans.choose.grade')}}...</option>
                                                                            @foreach($grades as $grade)
                                                                                <option value="{{$grade->id}}" {{$grade->id == $subject->gradeID ?"selected":""}}>
                                                                                    {{$grade->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                    </div>

                                                                    <div class="form-group col">
                                                                        <label for="inputState">{{trans('subject_trans.class')}}</label>
                                                                        <select name="classID" class="custom-select classesID">
                                                                            <option
                                                                                value="{{ $subject->class->id }}">{{ $subject->class->name }}
                                                                            </option>
                                                                        </select>
                                                                        
                                                                    </div>

                                                                    <div class="form-group col">
                                                                        <label for="inputState">{{trans('subject_trans.teacherName')}}</label>
                                                                        <select class="custom-select my-1 mr-sm-2" name="teacherID">
                                                                            <option selected disabled>{{trans('subject_trans.choose.teacher')}}...</option>
                                                                            @foreach($teachers as $teacher)
                                                                                <option value="{{$teacher->id}}" <?php if($teacher->id == $subject->teacherID ) echo "selected";?>>
                                                                                    {{$teacher->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            {{trans("subject_trans.close")}}
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger">
                                                                            {{trans("subject_trans.update")}}
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---end edit modal-->
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

@section("js")
    <script src="{{URL::asset('assets/js/custom/getClasses_ajax.js')}}"></script>
    <script>
        $('#subject').attr('class','active_my');
    </script>
@endsection
