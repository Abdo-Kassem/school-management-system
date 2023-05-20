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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grade->name}}</td>
                                            <td>{{$subject->class->name}}</td>
                                        </tr>
                                            
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
<script>
    $('#subject').attr('class','active_my');
</script>
@endsection
