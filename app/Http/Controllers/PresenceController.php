<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Resources\Api\Master\Children\ChildCardResource;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\Presence;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $Presence=Presence::whereIn("nursery_id",$nursery_id)->with([
            'days:name',
            'nursery:name',
            'master:first_name,last_name',
            'child',
        ])->get();

        return JsonResponse::successfulResponse('msg_created_succssfully', $Presence);


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
        try {
            if (!empty($request['child_id'])) {
                foreach ($request['child_id'] as $child_id) {
                    $presences = Presence::create([
                        'child_id' => $child_id,
                        'nursery_id' => $request->nursery_id,
                        'from_hour' => $request->from_hour,
                        'to_hour' => $request->to_hour,
                        'master_id' => $request->master_id,
                        'day' => $request->day,
                        'date' => $request->date,
                        'check' => $request->check,
                    ]);
                }
            }

            return JsonResponse::successfulResponse('msg_created_succssfully', $presences);

        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Nurseries\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
    public function show($child_id)
    {
        $presence=Presence::where("child_id",$child_id)->with([
            'days:name',
            'nursery:name',
            'master:first_name,last_name',
            'child',
        ])->get();
        return JsonResponse::successfulResponse('msg_created_succssfully', $presence);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
