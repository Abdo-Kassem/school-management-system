@extends('layouts.master')

@section('title')
    {{ trans('teacher_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('teacher_trans.title_page') }}
@stop
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#add_teacher">
                {{ __('teacher_trans.add_teacher') }}
            </button>


            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('teacher_trans.teacher_name') }}</th>
                            <th>{{ trans('teacher_trans.gender') }}</th>
                            <th>{{ trans('teacher_trans.joining_date') }}</th>
                            <th>{{ trans('teacher_trans.specialization') }}</th>
                            <th>{{ trans('teacher_trans.grade') }}</th>
                            <th>{{ trans('teacher_trans.address') }}</th>
                            <th>{{ trans('teacher_trans.phone') }}</th>
                            <th>{{ trans('teacher_trans.operation') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($teachers as $teacher)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td><?php echo trans('teacher_trans.gender_'.$teacher->gender) ?></td>
                                <td>{{ $teacher->joining_date }}</td>
                                <td>{{ $teacher->specialization->name }}</td>
                                <td>{{ $teacher->grade->name }}</td>
                                <td>{{ $teacher->address }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $teacher->id }}"
                                        title="{{ trans('teacher_trans.edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $teacher->id }}"
                                        title="{{ trans('teacher_trans.delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $teacher->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">
                                                {{ trans('teacher_trans.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class=" row mb-30" action="{{route('teacher.update')}}" method="POST">
                                                {{method_field('PATCH')}}
                                                @csrf 
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-6 pt-2">
                                                            <label for="email"
                                                                class="mr-sm-2">{{ trans('teacher_trans.email') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="email" id='email'
                                                                value = "{{$teacher->email}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="name_ar"
                                                                class="mr-sm-2">{{ trans('teacher_trans.name_ar') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="name_ar" id='name_ar'
                                                                    value="{{$teacher->getTranslation('name','ar')}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="name_en"
                                                                class="mr-sm-2">{{ trans('teacher_trans.name_en') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="name_en"
                                                                    value="{{$teacher->getTranslation('name','en')}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="phone"
                                                                class="mr-sm-2">{{ trans('teacher_trans.phone') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="phone" id='phone'
                                                                    value="{{$teacher->phone}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="salary"
                                                                class="mr-sm-2">{{ trans('teacher_trans.salary') }}
                                                                :</label>
                                                            <input class="form-control" type="number" name="salary" min='1500'
                                                                    value="{{$teacher->salary}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="address"
                                                                class="mr-sm-2">{{ trans('teacher_trans.address') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="address" id='address'
                                                                    value="{{$teacher->address}}">
                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="gender"
                                                                class="mr-sm-2">{{ trans('teacher_trans.gender') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="gender" id='gender'>
                                                                    <option value="male" <?php if($teacher->gender=='male') echo 'selected';?>>
                                                                        {{ trans('teacher_trans.gender_male') }}
                                                                    </option>
                                                                    <option value="female" <?php if($teacher->gender=='female') echo 'selected';?>>
                                                                        {{ trans('teacher_trans.gender_female') }}
                                                                    </option>
                                                                    <option value="other" <?php if($teacher->gender=='other') echo 'selected';?>>
                                                                        {{ trans('teacher_trans.gender_other') }}
                                                                    </option>    
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="specialization"
                                                                class="mr-sm-2">{{ trans('teacher_trans.specialization') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="specializationID" id='specialization'>
                                                                    @foreach($specializations as $specialization)
                                                                    <option value="{{$specialization->id}}" <?php if($teacher->specializationID === $specialization->id) echo'selected';?>>
                                                                        {{$specialization->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-6 pt-2">
                                                            <label for="grade"
                                                                class="mr-sm-2">{{ trans('teacher_trans.grade') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="p-2 form-control" name="gradeID" id='grade'>
                                                                    @foreach($grades as $grade)
                                                                    <option value="{{$grade->id}}" <?php if($teacher->gradeID === $grade->id) echo'selected';?>>
                                                                        {{$grade->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <input type='hidden' value="{{$teacher->id}}" name='teacherID'>

                                                        </div>

                                                    </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('teacher_trans.close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ trans('teacher_trans.update') }}</button>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_Teacher -->
                            <div class="modal fade" id="delete{{ $teacher->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('classes_trans.delete_study_year') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('teacher.destroy',$teacher->id) }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('teacher_trans.warning.delete') }}
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('teacher_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('teacher_trans.delete') }}</button>
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
<div class="modal fade" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('teacher_trans.add_teacher') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{route('teacher.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6 pt-2">
                                <label for="email"
                                    class="mr-sm-2">{{ trans('teacher_trans.email') }}
                                    :</label>
                                <input class="form-control" type="text" name="email" id='email'/>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="password"
                                    class="mr-sm-2">{{ trans('teacher_trans.password') }}
                                    :</label>
                                <input class="form-control" type="password" name="password" />
                            </div>

                            <div class="col-6 pt-2">
                                <label for="name_ar"
                                    class="mr-sm-2">{{ trans('teacher_trans.name_ar') }}
                                    :</label>
                                <input class="form-control" type="text" name="name_ar" id='name_ar'/>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="name_en"
                                    class="mr-sm-2">{{ trans('teacher_trans.name_en') }}
                                    :</label>
                                <input class="form-control" type="text" name="name_en" />
                            </div>

                            <div class="col-6 pt-2">
                                <label for="phone"
                                    class="mr-sm-2">{{ trans('teacher_trans.phone') }}
                                    :</label>
                                <input class="form-control" type="text" name="phone" id='phone' >
                            </div>

                            <div class="col-6 pt-2">
                                <label for="salary"
                                    class="mr-sm-2">{{ trans('teacher_trans.salary') }}
                                    :</label>
                                <input class="form-control" type="number" name="salary" min='1500'>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="address"
                                    class="mr-sm-2">{{ trans('teacher_trans.address') }}
                                    :</label>
                                <input class="form-control" type="text" name="address" id='address'>
                            </div>

                            <div class="col-6 pt-2">
                                <label for="gender"
                                    class="mr-sm-2">{{ trans('teacher_trans.gender') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="gender" id='gender'>
                                        <option value="male">{{ trans('teacher_trans.gender_male') }}</option>
                                        <option value="female">{{ trans('teacher_trans.gender_female') }}</option>
                                        <option value="other">{{ trans('teacher_trans.gender_other') }}</option>    
                                    </select>
                                </div>

                            </div>

                            <div class="col-6 pt-2">
                                <label for="specialization"
                                    class="mr-sm-2">{{ trans('teacher_trans.specialization') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="specializationID" id='specialization'>
                                        @foreach($specializations as $specialization)
                                        <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-6 pt-2">
                                <label for="grade"
                                    class="mr-sm-2">{{ trans('teacher_trans.grade') }}
                                    :</label>

                                <div class="box">
                                    <select class="p-2 form-control" name="gradeID" id='grade'>
                                        @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('teacher_trans.close') }}</button>
                            <button type="submit"
                                class="btn btn-success">{{ trans('teacher_trans.create') }}</button>
                        </div>


                    </div>
                </form>
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

<script type="text/javascript">
    function checkAll(className,obj) {
        elements = document.getElementsByClassName(className); //collection
        elements = Array.prototype.slice.call(elements);      ///convert collection to array
        if(obj.checked == true)
            elements.forEach(function(item){
                item.checked = true;
            });
        else
            elements.forEach(function(item){
                item.checked = false;
            });
    }
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>




@endsection