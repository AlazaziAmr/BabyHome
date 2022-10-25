<?php

namespace App\DataTables\Admin\Nursery\Adtional;

use App\Models\Api\Generals\Amenity;
use App\Models\Api\Generals\City;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AmenityDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($data) {
                if ($data->name) {
                    return $data->getTranslation('name', app()->getLocale(), false);
                } else {
                    return '';
                }
            })->addColumn('is_required', function ($data) {
                return $data->is_required ? __('site.yes') : __('site.no');
            })
            ->addColumn('action', 'dashboard.nurseries.addtional.amenities.partials._action')
            ->rawColumns(['action']);
    }

    public function query(Amenity $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->ajax(['url' => route('__bh_.amenities.index')])
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
            Column::make('is_required')->title(__('site.is_required'))->data('is_required')->name('is_required'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title(__('site.action'))
                ->addClass('text-center')
        ];
    }

    protected function filename(): string
    {
        return 'City_' . date('YmdHis');
    }
}
