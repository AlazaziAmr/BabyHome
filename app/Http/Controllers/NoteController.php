<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Resources\Api\Master\Children\ChildCardResource;
use App\Models\Api\Master\Master;
use App\Models\Note;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{
    use ApiTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function parent(Request $request)
    {
        $activation_code=Master::select('activation_code','phone')->where('phone',$request->phone)->get();
        if (!$activation_code->isEmpty()){
        $msg="تم إرجاع البيانات بنجاح";
        return $this->returnData($activation_code,$msg);
        }else{
            $msg="يرجئ التحقق من رقم الهاتف";
           return $this->returnEmpty($msg);
        }


    }
    public function nursery(Request $request)
    {
        $activation_code=User::select('activation_code','phone')->where('phone',$request->phone)->get();

        if (!$activation_code->isEmpty()){
            $msg="تم إرجاع البيانات بنجاح";
            return $this->returnData($activation_code,$msg);
        }else{
            $msg="يرجئ التحقق من رقم الهاتف";
            return $this->returnEmpty($msg);
        }    }

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
