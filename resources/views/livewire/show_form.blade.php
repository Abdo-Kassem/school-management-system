@extends('layouts.master')
@section('css')

@livewireStyles
@section('title')
    {{trans('main_trans.add_parent')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="color:#707070 !important; text-transform:capitalize"> {{trans('main_trans.add_parent')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}" class="default-color">{{trans('main_trans.home')}}</a>
                </li>
                <li class="breadcrumb-item active" >{{trans('main_trans.add_parent')}}</li>
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
                <livewire:add-parent>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@livewireScripts
<script>
    $('#parent').attr('class','active_my');
</script>

@endsection
