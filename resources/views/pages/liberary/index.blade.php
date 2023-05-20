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
                            @if (session()->has('fail'))
                                <div class="alert alert-danger">
                                    {{session('fail')}}
                                </div>
                            @elseif(session()->has('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                                <a href="{{route('book.create')}}" class="btn btn-primary btn-md" role="button"
                                   aria-pressed="true" style="text-transform:capitalize">
                                   {{trans('book_trans.add')}}
                                </a><br><br>
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
                                            <th>{{trans('book_trans.created_at')}}</th>
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
                                                <td>{{$book->added_at}}</td>
                                                <td>
                                                    <a href="{{route('book.download',$book->file_name)}}" title="{{trans('book_trans.download')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-download"></i></a>
                                                    <button data-target="#edit{{$book->id}}" class="btn btn-info btn-sm" role="button" data-toggle="modal" title="{{trans('book_trans.edit')}}"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $book->id }}" title="{{trans('book_trans.delete')}}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            @include('pages.liberary.delete_book')
                                            @include('pages.liberary.edit_book')
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
@section('js')
    <script src="{{URL::asset('assets/js/custom/getClasses_ajax.js')}}"></script>
    <script src="{{URL::asset('assets/js/custom/getTeachers_ajax.js')}}"></script>
    <script>
        $('#book').attr('class','active_my');
    </script>
@endsection