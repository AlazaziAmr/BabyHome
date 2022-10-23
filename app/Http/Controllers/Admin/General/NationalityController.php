<?php

namespace App\Http\Controllers\Admin\General;

use App\DataTables\Admin\General\NationalityDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NationalityController extends Controller
{
    public function index(NationalityDataTable $dataTable,Request $request){
        $data['title'] = __('site.nationalities');
        $data['icon'] = __('icon.nationalities');
        return $dataTable->render('dashboard.nationalities.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = array();


        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Nationality::findOrFail($id);
        return json_encode($form_data);
    }

    public function store(Request $request)
    {
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {

            $request_data['name'] = [
                'ar' => $request->ar_name,
                'en' => $request->en_name,
            ];

            Nationality::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Nationality::findOrFail($id);
        $returnHTML = view('dashboard.nationalities.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $nationality = Nationality::findOrFail($request->id);
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $request_data['name'] = [
                'ar' => $request->ar_name,
                'en' => $request->en_name,
            ];
            $nationality->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $nationality = Nationality::findOrFail($id);
        $nationality->delete();
        return response()->json(array('success' => true));
    }
}
