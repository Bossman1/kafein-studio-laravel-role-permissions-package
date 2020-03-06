<?php

namespace LaraPack\RolePermission\Http\Controllers\Admin;

use App\DataTables\GoalsDataTable;
use App\DataTables\RoleDataTable;
use App\Models\Goal;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\View\View;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleDataTable $dataTable
     * @return Factory|View
     */
    public function index(\LaraPack\RolePermission\DataTables\RoleDataTable $dataTable)
    {

        return view('larapack::admin.role.index', [
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
        return view('larapack::admin.role.edit',[
            'role' => new \LaraPack\RolePermission\Models\Role()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $goal
     * @return Factory|View
     */
    public function edit(\LaraPack\RolePermission\Models\Role $role)
    {
        return view('larapack::admin.role.edit', [
            'role' => $role,

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
            'slug' => 'required'
        ]);
        !empty($request->id) ? $model = \LaraPack\RolePermission\Models\Role::find($request->id) : $model = new \LaraPack\RolePermission\Models\Role();
        $requestArray = $request->toArray();
        $array =  [''=>''];
        $model->permissions =  $array;
        $model->fill($requestArray);
        if ($model->save()) {
            return redirect()->route('admin.role.index')->with('success', 'L\'objectif a été enregistré.');
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


    public function ajaxDataTable(\LaraPack\RolePermission\DataTables\RoleDataTable $dataTable)
    {
        return $dataTable->render('role');
    }

    public function generateSlug(Request $request){
        return str_slug($request->get('str'),'-');
    }

}
