@extends('admin.layouts.base')

@section('bodyClass') rolePage @endsection

@section('contentHeader')
    <h1>
        Assign permission
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.assign-permission.index') }}"><i class="fa fa-files-o"></i> Assign permission </a></li>
        <li>{{ !empty($role) ? 'Editer' : 'Ajouter' }}</li>
    </ol>
@endsection

@section('footerJs')
    <script src="{{asset('admin/js/app.assign-permission.js')}}"></script>
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
              action="{{ route('admin.assign-permission.save') }}">
            <div class="box-body">
                @csrf

                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="mtt_ht_cmd">Role name</label>
                            <input @if(!empty($role->id)) disabled @endif required name="role_name" type="text"
                                   class="form-control"
                                   placeholder="Role name"
                                   value="{{ !empty($role) ? $role->name : old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="mtt_ht_cmd">Role Slug</label>
                            <input @if(!empty($role->id)) disabled @endif   name="role_name" type="text"
                                   class="form-control"
                                   placeholder="Role Slug"
                                   value="{{ !empty($role) ? $role->slug : old('slug') }}">
                        </div>

                        <div class="form-group">
                            <label for="role_id">Assigned Permissions</label>
                            <select multiple name="permissions[]" id="" class="select2 form-control">
                                @foreach($permissions as $key => $permission)
                                    <option value="{{$permission->id}}"
                                            @if(in_array($permission->name, $rolePermissionsArray))
                                            selected
                                        @endif
                                    >{{$permission->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('permissions'))
                                <div class="text-danger">{{ $errors->first('permissions') }}</div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.assign-permission.index') }}" type="submit" class="btn btn-default">Annuler</a>
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
            <input type="hidden" name="id" value="{{ !empty($role) ? $role->id : '' }}">
        </form>
    </div>

@endsection





