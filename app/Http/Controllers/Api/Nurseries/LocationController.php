<?php

namespace App\Http\Controllers\Api\Nurseries;

use App\Http\Controllers\Controller;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Nurseries\Location;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = user()->id;
        $nursery=Nursery::where('user_id',$user_id)->select('id','uid','latitude','longitude')->first();
        $data['data']=[
            'id'=>$nursery->id,
            'uid'=>$nursery->uid,
            'latitude'=>$nursery->latitude,
            'longitude'=>$nursery->longitude,
        ];
        return $data ;

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = user()->id;
        if (Nursery::where('id', $request->nursery_id)->exists()) {
            $newLocation = Location::create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'nursery_id' => $request->nursery_id,
                'user_id' => $user_id,
            ]);
            return $newLocation;
        }else{
            return null;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Nurseries\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\Nurseries\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Nurseries\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location )
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Nurseries\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
