@extends('admin.layouts.base')

@section('bodyClass') permissionPage @endsection

@section('contentHeader')
    <h1>
        Permission
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.permission.index') }}"><i class="fa fa-files-o"></i> Permission </a></li>
        <li>{{ !empty($permission) ? 'Editer' : 'Ajouter' }}</li>
    </ol>
@endsection

@section('footerJs')
    <script src="{{asset('admin/js/app.permission.js')}}"></script>
@endsection

@section('content')
    @include('admin.includes.messages')

    <div class="formError callout callout-danger" style="display: none;">
        <p>Certains champs obligatoires n'ont pas été renseignés ou sont en erreur.</p>
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">
                Permission
            </h3>
        </div>
        <!-- /.box-header -->
        <form id="goalEdit" method="post" enctype="multipart/form-data" role="form"
              action="{{ route('admin.permission.save') }}">
            <div class="box-body">
                @csrf

                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="mtt_ht_cmd">Name *</label>
                            <input required  name="name" type="text"  class="form-control"
                                   placeholder="Name"
                                   value="{{ !empty($permission) ? $permission->name : old('name') }}">

                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.permission.index') }}" type="submit" class="btn btn-default">Annuler</a>
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
            <input type="hidden" name="id" value="{{ !empty($permission) ? $permission->id : '' }}">
        </form>
    </div>

@endsection





