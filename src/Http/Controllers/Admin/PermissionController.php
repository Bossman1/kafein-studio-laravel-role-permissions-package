<?php

namespace LaraPack\RolePermission\Http\Controllers\Admin;

use App\DataTables\GoalsDataTable;
use App\DataTables\PermissionDataTable;
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


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PermissionDataTable $dataTable
     * @return Factory|View
     */
    public function index(\LaraPack\RolePermission\DataTables\PermissionDataTable $dataTable)
    {
        return view('larapack::admin.permission.index', [
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
        return view('larapack::admin.permission.edit',[
            'permission' => new \LaraPack\RolePermission\Models\Permission()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $goal
     * @return Factory|View
     */
    public function edit(\LaraPack\RolePermission\Models\Permission $permission)
    {
        return view('larapack::admin.permission.edit', [
            'permission' => $permission,

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
        $validatedData = $request->validate([
            'name'=>'required',
        ]);
        !empty($request->id) ? $model = \LaraPack\RolePermission\Models\Permission::find($request->id) : $model = new \LaraPack\RolePermission\Models\Permission();
        $requestArray = $request->toArray();
        $model->fill($requestArray);
        if ($model->save()) {
            return redirect()->route('admin.permission.index')->with('success', 'L\'objectif a été enregistré.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function delete(\LaraPack\RolePermission\Models\Permission $permission)
    {
        $permission->forceDelete();
        return redirect()->route('admin.permission.index')->with('success', 'L\'objectif a été supprimé.');
    }


    public function ajaxDataTable(\LaraPack\RolePermission\DataTables\PermissionDataTable $dataTable)
    {
        return $dataTable->render('permission');
    }
}
