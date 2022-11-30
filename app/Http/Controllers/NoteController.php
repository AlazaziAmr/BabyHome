<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Resources\Api\Master\Children\ChildCardResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        foreach($request['child_id']as $k => $child_id) {


            $babySitter = Note::create([
                'notes' => $request->notes,
                'master_id' => $request->master_id,
                'nursery_id' => $request->nursery_id,
                'child_id' => $child_id,
                'status' => $request->status,
                'user_type' => $request->user_type,
            ]);
        }
        return JsonResponse::successfulResponse('msg_created_succssfully', $babySitter);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show( $child_id)
    {
        $note=Note::where("child_id",$child_id)->with('children')->get();
        return JsonResponse::successfulResponse('msg_created_succssfully', $note);
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
