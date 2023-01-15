<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class booking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking.aborted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Ten Minutes For Confirmed Booking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $time= Carbon::now()->format("H:i:s");
        $booking= \App\Models\Api\Master\BookingServices\Booking::where('status_id','1')->get();
        foreach ($booking as $item){
            $booking_time = Carbon::parse($item->booking_time)->format("H:i:s");

            $time = Carbon::parse($time);
            $diff_in_minutes = $time->diffInMinutes($booking_time);
            if ($diff_in_minutes  >10){
                $item->update([
                    'status_id'=>'2'
                ]);

            }


        }

    }
}
