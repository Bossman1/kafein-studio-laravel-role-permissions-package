@extends('admin.layouts.base')

@section('bodyClass') rolePage @endsection

@section('contentHeader')
    <h1>
        Role
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.role.index') }}"><i class="fa fa-files-o"></i> Role </a></li>
        <li>{{ !empty($role) ? 'Editer' : 'Ajouter' }}</li>
    </ol>
@endsection

@section('footerJs')
    <script src="{{asset('admin/js/app.role.js')}}"></script>
@endsection

@section('content')
    @include('admin.includes.messages')

    <div class="formError callout callout-danger" style="display: none;">
        <p>Certains champs obligatoires n'ont pas été renseignés ou sont en erreur.</p>
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">
                Role
            </h3>
        </div>
        <!-- /.box-header -->
        <form id="goalEdit" method="post" enctype="multipart/form-data" role="form"
              action="{{ route('admin.role.save') }}">
            <div class="box-body">
                @csrf

                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="mtt_ht_cmd">Name *</label>
                            <input required  name="name" type="text"  class="form-control role-name-selector"
                                   placeholder="Name"
                                   value="{{ !empty($role) ? $role->name : old('name') }}">

                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="mtt_ht_cmd">Slug *</label>
                            <input required  name="slug" type="text" min="1" class="form-control role-slug-selector"
                                   placeholder="Slug" value="{{ !empty($role) ? $role->slug : old('slug') }}">
                            @if ($errors->has('slug'))
                            <div class="text-danger">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.role.index') }}" type="submit" class="btn btn-default">Annuler</a>
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
            <input type="hidden" name="id" value="{{ !empty($role) ? $role->id : '' }}">
        </form>
    </div>

@endsection





