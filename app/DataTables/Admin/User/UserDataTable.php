<?php

namespace App\DataTables\Admin\User;

use App\Models\Api\Admin\Admin;
use App\Models\Api\Nurseries\Nursery;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('joining', function ($data) {
                return Carbon::parse($data->created_at)->format('Y-m-d  H:m:s');
            })->addColumn('verified', function ($data) {
                return $data->is_verified == 1 ? __('site.yes') : __('site.no');
            })->addColumn('active', function ($data) {
                return $data->is_active == 1 ? __('site.yes') : __('site.no');
            })
//            ->addColumn('action', 'dashboard.users.users.partials._action')
            ->rawColumns(['active'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        $q = $model->newQuery();
        $q->whereNotIn('id',Nursery::pluck('user_id')->toArray());
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
            ->ajax(['url' => route('__bh_.users.index')])
            ->buttons(
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->data('id')->name('id'),
            Column::make('joining')->title(__('site.joining_date'))->data('joining')->name('created_at'),
            Column::make('name')->title(__('site.name'))->data('name')->name('name'),
            Column::make('phone')->title(__('site.phone'))->data('phone')->name('phone'),
            Column::make('email')->title(__('site.email'))->data('email')->name('email'),
            Column::make('verified')->title(__('site.verified'))->data('verified')->name('verified'),
            Column::make('active')->title(__('site.active'))->data('active')->name('active'),
//            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->title(__('site.action'))
//                ->addClass('text-center')
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
