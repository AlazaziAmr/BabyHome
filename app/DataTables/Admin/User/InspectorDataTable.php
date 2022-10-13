<?php

namespace App\DataTables\Admin\User;

use App\Models\Api\Admin\Inspections\Inspection;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InspectorDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('nursery_name', function ($data) {
//                if(($data->nursery) and $data->nursery->user){
//                    return $data->nursery->user->name;
//                }else{
//                    return  '';
//                }
                return '';
            })->addColumn('status_lable', function ($data) {
               return $data->getStatusLabel();
            })
            ->addColumn('action', 'dashboard.nurseries.inspections.partials._action')
            ->rawColumns(['action','status_lable'])
            ->setRowId('id');
    }

    public function query(Inspection $model): QueryBuilder
    {
        $q = $model->newQuery();
        $q->where('Inspection',auth()->guard('dashbaord')->user()->id);
        $q->with(['nursery.user']);
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
            ->buttons(
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->data('id')->name('id'),
            Column::make('nursery_name')->title(__('site.nursery_name'))->data('nursery_name')->name('nursery_name'),
            Column::make('from')->title(__('site.from'))->data('from')->name('from'),
            Column::make('to')->title(__('site.to'))->data('to')->name('to'),
            Column::make('notes')->title(__('site.notes'))->data('notes')->name('notes'),
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
