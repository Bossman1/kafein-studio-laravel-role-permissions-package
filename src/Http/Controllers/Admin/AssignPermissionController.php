<?php

namespace LaraPack\RolePermission\Http\Controllers\Admin;

use App\DataTables\AssignPermissionDataTable;
use App\DataTables\AssignRoleDataTable;
use App\DataTables\GoalsDataTable;
use App\DataTables\RoleDataTable;
use App\Models\Goal;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\View\View;


class AssignPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AssignPermissionDataTable $dataTable
     * @return Factory|View
     */
    public function index(\LaraPack\RolePermission\DataTables\AssignPermissionDataTable $dataTable)
    {
        return view('larapack::admin.assign-permission.index', [
                'dataTable' => $dataTable,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     *
     */
    public function create()
    {
        $rolePermissionsArray = [];
        $permissions = \LaraPack\RolePermission\Models\Permission::orderBy('name')->get();
        return view('larapack::admin.assign-permission.edit',[
            'role' => new \LaraPack\RolePermission\Models\Role(),
            'permissions' => $permissions,
            'rolePermissionsArray' => $rolePermissionsArray
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Factory|View
     */
    public function edit(\LaraPack\RolePermission\Models\Role $role)
    {
        $rolePermissionsArray = [];
        foreach ($role->permissions as $name => $permission) {
            if($permission){
                $rolePermissionsArray[] = $name;
            }
        }
        $permissions = \LaraPack\RolePermission\Models\Permission::orderBy('name')->get();
        return view('larapack::admin.assign-permission.edit', [
            'role' => $role,
            'permissions' =>$permissions,
            'rolePermissionsArray'=> $rolePermissionsArray
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request)
    {


        !empty($request->id) ? $model = \LaraPack\RolePermission\Models\Role::find($request->id) : null;
        if($request->get('permissions')){
            $permissions = \LaraPack\RolePermission\Models\Permission::whereIn('id',$request->get('permissions'))->get();
            $makePermissionsArray = [];
            if($permissions){
                foreach ($permissions as $permission) {
                    $makePermissionsArray[$permission->name] = 1;
                }
            }
        }else{
            $makePermissionsArray = [];
        }

        $model->permissions =  $makePermissionsArray;
        if ($model->save()) {
            return redirect()->route('admin.assign-permission.index')->with('success', 'L\'objectif a été enregistré.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(\LaraPack\RolePermission\Models\Role $role)
    {
        $role->forceDelete();
        return redirect()->route('admin.role.index')->with('success', 'L\'objectif a été supprimé.');
    }


    public function ajaxDataTable(\LaraPack\RolePermission\DataTables\AssignPermissionDataTable $dataTable)
    {
        return $dataTable->render('assign-permission');
    }
}
