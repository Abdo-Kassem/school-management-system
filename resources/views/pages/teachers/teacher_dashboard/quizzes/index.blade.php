@extends('layouts.master')

@section('title')
    {{trans('quizz_trans.title_page')}}
@endsection

    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('quizz_trans.title_page')}}
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
                                <a href="{{route('teacher.quizz.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('quizz_trans.add')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('quizz_trans.name')}}</th>
                                            <th>{{trans('quizz_trans.grade')}}</th>
                                            <th>{{trans('quizz_trans.class')}}</th>
                                            <th>{{trans('quizz_trans.classroom')}}</th>
                                            <th>{{trans('quizz_trans.subject')}}</th>
                                            <th>{{trans('quizz_trans.teacherName')}}</th>
                                            <th>{{trans('quizz_trans.operation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizz)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$quizz->name}}</td>
                                            <td>{{$quizz->grade->name}}</td>
                                            <td>{{$quizz->class->name}}</td>
                                            <td>{{$quizz->classroom->name}}</td>
                                            <td>{{$quizz->subject->name}}</td>
                                            <td>{{$quizz->teacher->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $quizz->id }}" title="{{trans('quizz_trans.delete')}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $quizz->id }}" title="{{trans('quizz_trans.edit')}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    
                                                    <a href="{{route('teacher.questions.index',$quizz->id)}}" class="btn btn-primary btn-sm"  title="{{trans('quizz_trans.show')}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('quizz.answer',$quizz->id)}}"  title="{{trans('quizz_trans.answer_show')}}"
                                                        style="display:inline-block;width:26px;height:26px;">
                                                        <img src="{{URL::asset('assets\images\answer.png')}}" alt="" style="display:inline-block;width:100%;height:100%">
                                                    </a>
                                                </td>
                                            </tr>
                                            <!--start delete modal -->
                                            <div class="modal fade" id="delete{{$quizz->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('teacher.quizz.destroy',$quizz->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('quizz_trans.delete')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{trans('subject_trans.warning.delete')}} {{$quizz->name}}</p>
                                                            <input type="hidden" name="id"  value="{{$quizz->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{trans('quizz_trans.close')}}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{trans('quizz_trans.delete')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end delete modal-->
                                            <!--start edit modal-->
                                            <div class="modal fade " id="edit{{$quizz->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('quizz_trans.edit')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('teacher.quizz.update')}}" method="post">
                                                                {{csrf_field()}}

                                                                <div class="form-row">

                                                                    <div class="col">
                                                                        <label for="title">{{trans('quizz_trans.name_ar')}}</label>
                                                                        <input type="text" name="name_ar" class="form-control"
                                                                            value="{{$quizz->getTranslation('name','ar')}}">
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="title"> {{trans('quizz_trans.name_en')}}</label>
                                                                        <input type="text" name="name_en" class="form-control"
                                                                            value="{{$quizz->getTranslation('name','en')}}">

                                                                        <input type="hidden" name='id' value="{{$quizz->id}}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="grades"> {{trans('quizz_trans.grades')}}</label>
                                                                        <input type="number" name="grades" class="form-control" id="grades"
                                                                        value="{{$quizz->grades}}">
                                                                        @error('grades')
                                                                        <span class='text-danger'>{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <div class="form-row">

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="Grade_id"> {{trans('quizz_trans.grade')}} : <span class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2" name="gradeID">
                                                                                <option selected disabled> {{trans('quizz_trans.choose.grade')}}...</option>
                                                                                @foreach($grades as $grade)
                                                                                    <option  value="{{ $grade->id }}" <?php if($quizz->grade->id == $grade->id) echo 'selected';?>>
                                                                                        {{ $grade->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="Classroom_id">{{trans('quizz_trans.choose.class')}} : <span class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2 classesID" name="classID">
                                                                                <option value="{{$quizz->class->id}}">{{$quizz->class->name}}</option>
                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="section_id">{{trans('quizz_trans.choose.classroom')}} : </label>
                                                                            <select class="custom-select mr-sm-2 classroomID" name="classroomID">
                                                                                <option value="{{$quizz->classroom->id}}">{{$quizz->classroom->name}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-row">

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="subject">{{trans('quizz_trans.subject')}} : <span class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2" name="subjectID" id='subject'>
                                                                                <option selected disabled>{{trans('quizz_trans.choose.subject')}}...</option>
                                                                                @foreach($subjects as $subject)
                                                                                    <option  value="{{ $subject->id }}" <?php if($quizz->subject->id == $subject->id) echo 'selected';?>>
                                                                                        {{ $subject->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
             
                                                                </div>
                            
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            {{trans("quizz_trans.close")}}
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger">
                                                                            {{trans("quizz_trans.update")}}
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
    <script src="{{URL::asset('assets/js/custom/getClassroom_ajax.js')}}"></script>
    <script src="{{URL::asset('assets/js/custom/getTeachers_ajax.js')}}"></script>
    <script>
        $('#quizz').attr('class','active_my');
    </script>
@endsection
