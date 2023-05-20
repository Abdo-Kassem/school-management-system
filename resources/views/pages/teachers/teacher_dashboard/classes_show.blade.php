@extends('layouts.master')

@section('title')
    {{ trans('classes_trans.page_title') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('classes_trans.page_title') }}
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

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                    
                            <th>#</th>
                            <th>{{ trans('classes_trans.study_year_name') }}</th>
                            <th>{{ trans('classes_trans.grade_name') }}</th>
                        
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; ?>

                        @foreach ($classes as $class)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->grade->name }}</td>
                            
                            </tr>

                            
                        @endforeach
                </table>
            </div>
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


<script>
    $('#class').attr('class','active_my');
</script>

@endsection