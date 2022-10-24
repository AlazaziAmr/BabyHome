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
            })->addColumn('inspector', function ($data) {
                return $data->getInspector();
            })->addColumn('status_lable', function ($data) {
                if($data->status == 0){
                    return '<span class="badge badge-sm bg-gradient-secondary">'.__('site.submitted').'</span>';
                }else if($data->status == 1){
                    return '<span class="badge badge-sm bg-gradient-warning">'.__('site.reviewing').'</span>';
                }else if($data->status == 2){
                    return '<span class="badge badge-sm bg-gradient-primary">'.__('site.inspecting').'</span>';
                }else if($data->status == 3){
                    return '<span class="badge badge-sm bg-gradient-info">'.__('site.inspected').'</span>';
                }else if($data->status == 4){
                    return '<span class="badge badge-sm bg-gradient-danger">'.__('site.suspended').'</span>';
                }else if($data->status == 5){
                    return '<span class="badge badge-sm bg-gradient-success">'.__('site.approved').'</span>';
                }
            })
            ->addColumn('action', 'dashboard.nurseries.nurseries.partials._action')
            ->rawColumns(['action','status_lable'])
            ->setRowId('id');
    }

    public function query(Nursery $model): QueryBuilder
    {
        $q = $model->newQuery();
        $q->with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name','inspection','inspection.inspector']);
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
            Column::make('id')->title('الرقم التسلسلي')->data('id')->name('id'),
            Column::make('owner_name')->title(__('site.owner_name'))->data('owner_name')->name('owner_name'),
            Column::make('inspector')->title(__('site.inspector'))->data('inspector')->name('inspector'),
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
