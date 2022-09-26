<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FireBaseNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $backoff = 4;

    public $tries = 5;

    protected $title;

    protected $description;

    protected $imageUrl;

    protected $userType;

    protected $ids;

    protected $entityId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $description, $imageUrl, $userType, $ids, $entityId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->userType = $userType;
        $this->ids = $ids;
        $this->entityId = $entityId;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sendFireBaseNotification(
            $this->title,
            $this->description,
            $this->imageUrl,
            $this->userType,
            $this->ids,
            $this->entityId
        );
    }
}
