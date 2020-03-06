@extends('admin.layouts.base')

@section('bodyClass') rolePage @endsection

@section('contentHeader')
<h1>
    Role
</h1>

<ol class="breadcrumb">
    <li><a href="{{ route('admin.role.index') }}"><i class="fa fa-users"></i> Role </a></li>
</ol>
@endsection

@section('footerJs')
    <script src="{{asset('admin/js/app.role.js')}}"></script>
{!! $dataTable->html()->scripts() !!}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        @include('admin.includes.messages')


        <div class="box box-solid">
            <div class="box-body">
                <div class="tableActions">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-social btn-primary">
                        <i class="fa fa-plus"></i> Ajouter
                    </a>
                </div>
                <div class="tableActions">
                </div>

                {!! $dataTable->html()->table() !!}

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
