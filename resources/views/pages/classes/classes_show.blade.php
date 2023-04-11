@extends('layouts.master')

@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('My_Classes_trans.title_page') }}
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

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('classes_trans.add_study_year') }}
            </button>

            <button type="button" class="button x-small" id="btn_delete_all">
                {{ trans('classes_trans.delete_checkbox') }}
            </button>


            <br><br>

                <form action="{{route('classes.filter')}}" method="get">
                    <select class="form-control mb-3 p-2 w-25"  name="gradeID" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('classes_trans.search_by_grade') }}</option>
                        @foreach ($Grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                        @endforeach
                    </select>
                </form>



            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" value="-1" onclick="checkAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('classes_trans.study_year_name') }}</th>
                            <th>{{ trans('classes_trans.grade_name') }}</th>
                            <th>{{ trans('classes_trans.operations') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (isset($details))

                        <?php $List_Classes = $details; ?>
                    @else

                        <?php $List_Classes = $My_Classes; ?>
                    @endif

                        <?php $i = 0; ?>

                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $My_Class->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $My_Class->name }}</td>
                                <td>{{ $My_Class->grade->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('classes_trans.save') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('classes_trans.delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('classes_trans.edit_classes_header') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('classes.update') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                               class="mr-sm-2">{{ trans('classes_trans.study_year_name_ar') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="name_ar"
                                                               class="form-control"
                                                               value="{{ $My_Class->getTranslation('name', 'ar') }}"
                                                               >
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $My_Class->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('classes_trans.study_year_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $My_Class->getTranslation('name', 'en') }}"
                                                               name="name_en" >
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label
                                                        for="grade">{{ trans('classes_trans.grade_name_choice') }}
                                                        :</label>
                                                    <select class="form-control form-control-lg p-2"
                                                            id="grade" name="gradeID">
                                                        <option value="{{ $My_Class->grade->id }}" >
                                                            {{ $My_Class->grade->name }}
                                                        </option>
                                                        @foreach ($Grades as $Grade)
                                                            <option value="{{ $Grade->id }}">
                                                                {{ $Grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('classes_trans.save') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('classes.destroy',$My_Class->id) }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                {{ trans('classes_trans.warning_study_year') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $My_Class->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('classes_trans.delete') }}</button>
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


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classes_trans.addition_header') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{route('classes.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="name_ar"
                                                class="mr-sm-2">{{ trans('classes_trans.study_year_name_ar') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_ar" id='name_ar'/>
                                        </div>


                                        <div class="col">
                                            <label for="name_en"
                                                class="mr-sm-2">{{ trans('classes_trans.study_year_name_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_en" />
                                        </div>


                                        <div class="col">
                                            <label for="grade_name"
                                                class="mr-sm-2">{{ trans('classes_trans.grade_name_choice') }}
                                                :</label>

                                            <div class="box">
                                                <select class="p-2 form-control" name="gradeID" id='grade_name'>
                                                    @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('classes_trans.operations') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('classes_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('classes_trans.create') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
</div>



<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classes_trans.checkbox_delete_list') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('classes.destroy.all')}}" method="POST">
                {{method_field('delete')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('classes_trans.warning_study_year_delete_list') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('classes_trans.delete') }}</button>
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