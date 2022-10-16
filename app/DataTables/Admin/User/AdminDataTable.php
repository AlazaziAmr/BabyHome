<?php

namespace App\DataTables\Admin\User;

use App\Models\Api\Admin\Admin;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('role',function ($data){
                $result = '';
                foreach ($data->getRoleNames() as $name){
                    $result .= '-'.$name.'<br>';
                }
                return $result;
            })
            ->addColumn('action', 'dashboard.users.admins.partials._action')
            ->rawColumns(['action','role'])
            ->setRowId('id');
    }

    public function query(Admin $model): QueryBuilder
    {
        $q = $model->newQuery();
        $q->with('roles');
        return  $q;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->ajax(['url' => route('__bh_.admins.index')])
            ->buttons(
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->data('id')->name('id'),
            Column::make('name')->title(__('site.name'))->data('name')->name('name'),
            Column::make('phone')->title(__('site.phone'))->data('phone')->name('phone'),
            Column::make('email')->title(__('site.email'))->data('email')->name('email'),
            Column::make('role')->title(__('site.role'))->data('role')->name('role'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title(__('site.action'))
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
