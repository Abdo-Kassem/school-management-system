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

<div class="col-xl-12 mb-30" >
    <div class="card card-statistics h-100" style="overflow:visible !important">
        <div class="card-body" >

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

            <button type="button" class="button x-small" data-toggle="modal" data-target="#add_student"
                    style="text-transform:capitalize">
                {{ __('student_trans.add_student') }}
            </button>

            

            <div class="table-responsive" style="overflow:visible !important">
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
                            <th>{{ trans('student_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($students as $student)
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
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button type="button" class="text-success dropdown-item" data-toggle="modal"
                                                data-target="#edit{{ $student->id }}">
                                                <i class="fa fa-edit" style='margin:2px'></i>
                                                {{ trans('student_trans.edit') }}
                                            </button>
                                            <button type="button" class="text-danger dropdown-item" data-toggle="modal"
                                                data-target="#delete{{ $student->id }}">
                                                <i class="fa fa-trash" style='margin:2px'></i>{{ trans('student_trans.delete') }}
                                            </button>
                                            <a href="{{route('student.show',$student->id)}}" class="text-warning dropdown-item" >
                                                <i class="fa fa-eye" style='color:red;margin:2px'></i>
                                                {{ trans('student_trans.show') }}
                                            </a>
                                            <a href="{{route('student_fees.create',$student->id)}}" class="text-warning dropdown-item" >
                                                <i class="fa fa-plus" style='margin:2px'></i>
                                                {{ trans('student_trans.addStudentFees') }}
                                            </a>
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>

                            <!-- edit_modal_student -->
                            <div class="modal fade" id="edit{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('student_trans.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class=" row mb-30" action="{{route('student.update')}}" method="POST">
                                                {{method_field('patch')}}
                                                @csrf
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-12 pt-2">
                                                            <label for="email"
                                                                class="mr-sm-2">{{ trans('student_trans.email') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="email" id='email'
                                                                value="{{$student->email}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="name_ar"
                                                                class="mr-sm-2">{{ trans('student_trans.name_ar') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="name_ar" id='name_ar'
                                                                value="{{$student->getTranslation('name','ar')}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="name_en"
                                                                class="mr-sm-2">{{ trans('student_trans.name_en') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="name_en" 
                                                                value="{{$student->getTranslation('name','en')}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="address"
                                                                class="mr-sm-2">{{ trans('student_trans.address') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="address" id='address'
                                                                value="{{$student->address}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="birthDate"
                                                                class="mr-sm-2">{{ trans('student_trans.birth.date') }}
                                                                :</label>
                                                            <input class="form-control" type="date" name="birthDate" id='birthDate'
                                                                value="{{$student->birth_date}}">
                                                            
                                                        </div>

                                                        <div class="hidden">
                                                            <input type='hidden' name='studentID' value="{{$student->id}}">
                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="gender"
                                                                class="mr-sm-2">{{ trans('student_trans.gender') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="gender" id='gender'>
                                                                    <option value="male" <?php if($student->gender == 'male') echo'selected';?>>
                                                                        {{ trans('student_trans.gender_male') }}
                                                                    </option>
                                                                    <option value="female" <?php if($student->gender == 'female') echo'selected';?>>
                                                                        {{ trans('student_trans.gender_female') }}
                                                                    </option>
                                                                    <option value="other" <?php if($student->gender == 'other') echo'selected';?>>
                                                                        {{ trans('student_trans.gender_other') }}
                                                                    </option>    
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-4 pt-2">
                                                            <label for="acadimic_year"
                                                                class="mr-sm-2">{{ trans('student_trans.acadimy_year') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="acadimy_year" id='acadimic_year'>
                                                                    <option value="{{date('Y')}}" <?php if($student->academic_year == date('Y')) echo'selected';?>>
                                                                        {{date('Y')}}
                                                                    </option>
                                                                    <option value="{{date('Y')+1}}" <?php if($student->academic_year == date('Y')+1) echo'selected';?>>
                                                                        {{date('Y')+1}}
                                                                    </option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    
                                                        <div class="col-4 pt-2">
                                                            <label for="religion"
                                                                class="mr-sm-2">{{ trans('student_trans.religion') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="religionID" id='religion'>
                                                                    @foreach($religions as $religion)
                                                                    <option value="{{$religion->id}}" <?php if($student->religionID === $religion->id) echo'selected';?>>
                                                                        {{$religion->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="nationality"
                                                                class="mr-sm-2">{{ trans('student_trans.nationality') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="nationalityID" id='nationality'>
                                                                    @foreach($nationalities as $nationality)
                                                                    <option value="{{$nationality->id}}" <?php if($student->nationalitie_ID === $nationality->id) echo'selected';?>>
                                                                        {{$nationality->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="blood"
                                                                class="mr-sm-2">{{ trans('student_trans.blood') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="bloodID" id='blood'>
                                                                    @foreach($bloods as $blood)
                                                                    <option value="{{$blood->id}}" <?php if($student->bloodID === $blood->id) echo'selected';?>>
                                                                        {{$blood->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="parent"
                                                                class="mr-sm-2">{{ trans('student_trans.parent') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="parentID" id='parent'>
                                                                    @foreach($parents as $parent)
                                                                    <option value="{{$parent->id}}" <?php if($student->parentID === $parent->id) echo'selected';?>>
                                                                        {{$parent->fatherName}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="grade"
                                                                class="mr-sm-2">{{ trans('student_trans.grade') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="gradeID" id='grade'>
                                                                    <option value="0" disabled>{{trans('student_trans.choose.grade')}}</option>
                                                                    @foreach($grades as $grade)
                                                                    <option value="{{$grade->id}}" <?php if($student->gradeID === $grade->id) echo'selected';?>>
                                                                        {{$grade->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="class"
                                                                class="mr-sm-2">{{ trans('student_trans.class') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control classesID" name="classID" id='class'>
                                                                    <option value="{{$student->classID}}">{{$student->class->name}}</option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 pt-2">
                                                            <label for="classroom"
                                                                class="mr-sm-2">{{ trans('student_trans.classroom') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control classroomID" name="classroomID" id='classroom'>
                                                                    <option value="{{$student->classroomID}}">{{$student->classroom->name}}</option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                    </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" 
                                                            data-dismiss="modal">{{ trans('teacher_trans.close') }}
                                                        </button>
                                                        <button type="submit" name='update'
                                                            class="btn btn-success">{{ trans('teacher_trans.update') }}
                                                        </button>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end edit student-->
                            <!-- delete_modal_student -->
                            <div class="modal fade" id="delete{{ $student->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('student_trans.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('student.destroy',$student->id) }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('teacher_trans.warning.delete') }}
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('student_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('student_trans.delete') }}</button>
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
<div class="modal fade" id="add_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('student_trans.add_student') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6 pt-2">
                                <label for="email"
                                    class="mr-sm-2">{{ trans('student_trans.email') }}
                                    :</label>
                                <input class="form-control" type="text" name="email" id='email'/>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="password"
                                    class="mr-sm-2">{{ trans('student_trans.password') }}
                                    :</label>
                                <input class="form-control" type="password" name="password" />
                            </div>

                            <div class="col-6 pt-2">
                                <label for="name_ar"
                                    class="mr-sm-2">{{ trans('student_trans.name_ar') }}
                                    :</label>
                                <input class="form-control" type="text" name="name_ar" id='name_ar'/>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="name_en"
                                    class="mr-sm-2">{{ trans('student_trans.name_en') }}
                                    :</label>
                                <input class="form-control" type="text" name="name_en" />
                            </div>

                            <div class="col-6 pt-2">
                                <label for="phone"
                                    class="mr-sm-2">{{ trans('student_trans.address') }}
                                    :</label>
                                <input class="form-control" type="text" name="address" id='phone' >
                            </div>

                            <div class="col-6 pt-2">
                                <label for="salary"
                                    class="mr-sm-2">{{ trans('student_trans.birth.date') }}
                                    :</label>
                                <input class="form-control" type="date" name="birthDate">
                                
                            </div>

                            <div class="col-4 pt-2">
                                <label for="gender"
                                    class="mr-sm-2">{{ trans('student_trans.gender') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="gender" id='gender'>
                                        <option value="male">{{ trans('student_trans.gender_male') }}</option>
                                        <option value="female">{{ trans('student_trans.gender_female') }}</option>
                                        <option value="other">{{ trans('student_trans.gender_other') }}</option>    
                                    </select>
                                </div>

                            </div>
                            <div class="col-4 pt-2">
                                <label for="acadimic_year"
                                    class="mr-sm-2">{{ trans('student_trans.acadimy_year') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="acadimy_year" id='acadimic_year'>
                                        <option value="{{date('Y')}}">{{date('Y')}}</option>
                                        <option value="{{date('Y')+1}}">{{date('Y')+1}}</option>
                                    </select>
                                </div>

                            </div>
                          
                            <div class="col-4 pt-2">
                                <label for="religion"
                                    class="mr-sm-2">{{ trans('student_trans.religion') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="religionID" id='religion'>
                                        @foreach($religions as $religion)
                                        <option value="{{$religion->id}}">{{$religion->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="nationality"
                                    class="mr-sm-2">{{ trans('student_trans.nationality') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="nationalityID" id='nationality'>
                                        @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="blood"
                                    class="mr-sm-2">{{ trans('student_trans.blood') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="bloodID" id='blood'>
                                        @foreach($bloods as $blood)
                                        <option value="{{$blood->id}}">{{$blood->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="parent"
                                    class="mr-sm-2">{{ trans('student_trans.parent') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="parentID" id='parent'>
                                        @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->fatherName}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="grade"
                                    class="mr-sm-2">{{ trans('student_trans.grade') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="gradeID" id='grade'>
                                        <option value="0" disabled selected>{{trans('student_trans.choose.grade')}}</option>
                                        @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="class"
                                    class="mr-sm-2">{{ trans('student_trans.class') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control classesID" name="classID" id='class'>
                                        
                                    </select>
                                </div>

                            </div>

                            <div class="col-4 pt-2">
                                <label for="classroom"
                                    class="mr-sm-2">{{ trans('student_trans.classroom') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control classroomID" name="classroomID" id='classroom'>
                                        
                                    </select>
                                </div>

                            </div>

                            <div class="col-12 pt-2">
                                <label for="attachments"
                                    class="mr-sm-2">{{ trans('student_trans.attachments') }}
                                    :</label>

                                <div class="box">
                                    <input type='file' class="p-2 form-control" name="attachments[]" 
                                        id='attachments' accept="image/*" multiple>
                                </div>

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
<script type="text/javascript" src="{{URL::asset('assets\js\custom\getClassroom_ajax.js')}}"></script>

<script>
    $('#student').attr('class','active_my');
</script>

@endsection