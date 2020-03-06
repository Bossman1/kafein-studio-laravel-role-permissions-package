<?php

namespace LaraPack\RolePermission\DataTables;

use App\Models\Goal;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($role) {
                return '<a class="jsOnRowCLickTarget" data-toggle="tooltip" title="Editer l\' role" href="' . route('admin.role.edit', $role) . '"><i class="fa fa-pencil mr-8 text-primary"></i></a>'
                    . '<a class="pull-right" data-toggle="tooltip" title="Supprimer l\' role" href="' . route('admin.role.delete', $role) . '"><i class="deleteRole fa fa-times text-danger"></i></a>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return Role[]|Collection
     */
    public function query(Role $model)
    {
        return $model->newQuery()->orderBy('name')->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableAttributes(['id' => 'roleTable', 'class' => 'table table-bordered table-hover jsOnRowCLick c-pointer'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ajax(['url' => route('admin.role.ajax.datatable')])
            ->addAction(['width' => '35px', 'title' => ''])
            ->parameters(['order' => [[0, 'asc']]] + config('datatables.defaultParameters'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['title' => 'Name'],
            'slug' => ['title' => 'Slug'],
        ];
    }


}
