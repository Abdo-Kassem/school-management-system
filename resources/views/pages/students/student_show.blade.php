@extends('layouts.master')

@section('title')
    {{ trans('student_trans.title_page') }}
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('student_trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="default-color">{{trans('breadcrump_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('student_trans.title_page')}}</li>
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
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @elseif(session()->has('fail'))
                        <div class="alert alert-danger">
                            {{session('fail')}}
                        </div>
                        @endif
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('student_trans.student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('student_trans.attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th>{{ trans('student_trans.student_name') }}</th>
                                            <td>{{$student->name}}</td>

                                            <th>{{ trans('student_trans.email') }}</th>
                                            <td>{{$student->email}}</td>

                                            <th>{{ trans('student_trans.gender') }}</th>
                                            <td>{{trans('student_trans.'.'gender_'.$student->gender)}}</td>

                                            <th>{{ trans('student_trans.acadimy_year') }}</th>
                                            <td>{{$student->academic_year}}</td>

                                        </tr>

                                        <tr>
                                            <th>{{ trans('student_trans.birth.date') }}</th>
                                            <td>{{ $student->birth_date }}</td>

                                            <th >{{ trans('student_trans.address') }}</th>
                                            <td colspan="3">{{ $student->address }}</td>

                                            <th>{{ trans('student_trans.parent') }}</th>
                                            <td>{{ $student->parent->fatherName }}</td>
                                            
                                        </tr>

                                        <tr>
                                            <th>{{ trans('student_trans.religion') }}</th>
                                            <td>{{ $student->religion->name }}</td>

                                            <th>{{ trans('student_trans.nationality') }}</th>
                                            <td>{{ $student->nationality->name }}</td>

                                            <th>{{ trans('student_trans.blood') }}</th>
                                            <td>{{ $student->blood->name }}</td>.

                                            <th>{{ trans('student_trans.grade') }}</th>
                                            <td>{{ $student->grade->name }}</td>

                                        </tr>

                                        <tr>

                                            <th>{{ trans('student_trans.class') }}</th>
                                            <td>{{ $student->class->name }}</td>

                                            <th>{{ trans('student_trans.classroom') }}</th>
                                            <td>{{ $student->classroom->name }}</td>
                                            
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('upload.attachment')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('student_trans.attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="images[]" multiple required>
                                                        <input type="hidden" name="studentName" value="{{$student->name}}">
                                                        <input type="hidden" name="studentID" value="{{$student->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('student_trans.upload')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('student_trans.fileName')}}</th>
                                                <th scope="col">{{trans('student_trans.created_at')}}</th>
                                                <th scope="col">{{trans('student_trans.operation')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->fileName}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href=""
                                                           role="button"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>&nbsp; {{trans('student_trans.download')}}
                                                        </a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('student_trans.delete.attachment') }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                                {{trans('student_trans.delete.attachment')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.students.delete_attachment')
                                            @endforeach
                                            </tbody>
                                        </table>
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

@endsection
