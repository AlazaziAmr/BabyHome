<?php

namespace App\DataTables\Admin\Nursery;

use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NurseryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('owner_name', function ($data) {
                if($data->owner){
                    return $data->owner->name;
                }else{
                    return  '';
                }
            })->addColumn('owner_phone', function ($data) {
                if($data->owner){
                    return $data->owner->phone;
                }else{
                    return  '';
                }
            })->addColumn('status_lable', function ($data) {
               return $data->getStatusLabel();
            })
            ->addColumn('action', 'dashboard.nurseries.nurseries.partials._action')
            ->rawColumns(['action','status_lable'])
            ->setRowId('id');
    }

    public function query(Nursery $model): QueryBuilder
    {
        $q = $model->newQuery();
        $q->with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name']);
        return  $q;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->ajax(['url' => route('__bh_.nurseries.index')])
            ->orderBy(1)
            ->buttons(
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->data('id')->name('id'),
            Column::make('owner_name')->title(__('site.owner_name'))->data('owner_name')->name('owner_name'),
            Column::make('owner_phone')->title(__('site.owner_phone'))->data('owner_phone')->name('owner_phone'),
            Column::make('national_address')->title(__('site.national_address'))->data('national_address')->name('national_address'),
            Column::make('capacity')->title(__('site.capacity'))->data('capacity')->name('capacity'),
            Column::make('status_lable')->title(__('site.status_lable'))->data('status_lable')->name('status_lable'),
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
