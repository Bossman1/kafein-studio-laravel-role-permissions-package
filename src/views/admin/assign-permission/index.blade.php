@extends('admin.layouts.base')

@section('bodyClass') rolePage @endsection

@section('contentHeader')
    <h1>
        Assign permission
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.assign-permission.index') }}"><i class="fa fa-users"></i> Assign permission </a></li>
    </ol>
@endsection

@section('footerJs')
    <script src="{{asset('admin/js/app.assign-permission.js')}}"></script>
    {!! $dataTable->html()->scripts() !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('admin.includes.messages')
            <div class="box box-solid">
                <div class="box-body">
                    {!! $dataTable->html()->table() !!}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
