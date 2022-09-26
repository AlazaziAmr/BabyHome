<?php

namespace App\Observers\Api\Nurseries;

use App\Models\Api\Admin\Admin;
use App\Notifications\Notifications;
use App\Models\Api\Nurseries\Nursery;

class NurseryObserver
{
    /**
     * Handle the Nursery "created" event.
     *
     * @param  \App\Models\Nursery  $nursery
     * @return void
     */
    public function created(Nursery $nursery)
    {
        $ids = Admin::permission('view nurseries')->pluck('id')->toArray();
        foreach ($ids as $id) {
            Admin::find($id)->notifiable()->create([
                'title' => $nursery['national_address'] . ' : ' . $nursery['address_description'],
                'description' => trans('responses.nursery_created'),
            ]);
        }
//        Notifications::through(['mobile'])->to('admin', $ids)->send($nursery['national_address'] . ' : ' . $nursery['address_description'], trans('responses.nursery_created'));
    }

    /**
     * Handle the Nursery "updated" event.
     *
     * @param  \App\Models\Nursery  $nursery
     * @return void
     */
    public function updated(Nursery $nursery)
    {
        //
    }

    /**
     * Handle the Nursery "deleted" event.
     *
     * @param  \App\Models\Nursery  $nursery
     * @return void
     */
    public function deleted(Nursery $nursery)
    {
        //
    }

    /**
     * Handle the Nursery "restored" event.
     *
     * @param  \App\Models\Nursery  $nursery
     * @return void
     */
    public function restored(Nursery $nursery)
    {
        //
    }

    /**
     * Handle the Nursery "force deleted" event.
     *
     * @param  \App\Models\Nursery  $nursery
     * @return void
     */
    public function forceDeleted(Nursery $nursery)
    {
        //
    }
}
