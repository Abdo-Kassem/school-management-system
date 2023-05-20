@extends('layouts.master')

   
@section('title')
    {{trans('book_trans.title_page')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('book_trans.title_page')}}
@stop
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
                           <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('book_trans.name')}}</th>
                                            <th>{{trans('book_trans.teacherName')}}</th>
                                            <th>{{trans('book_trans.grade')}}</th>
                                            <th>{{trans('book_trans.class')}}</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teacher->name}}</td>
                                                <td>{{$book->grade->name}}</td>
                                                <td>{{$book->class->name}}</td>
                                                <td>
                                                    <a href="{{route('student.book.download',$book->file_name)}}" title="{{trans('book_trans.download')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-download"></i></a>
                            
                                                </td>
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
