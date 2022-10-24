<?php

namespace App\Http\Controllers\Admin\Nursery\Addtioanl;

use App\DataTables\Admin\Nursery\Adtional\QualificationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class QualificationController extends Controller
{
    public function index(QualificationDataTable $dataTable,Request $request){
        $data['title'] = __('site.qualifications');
        $data['icon'] = __('icon.qualifications');
        return $dataTable->render('dashboard.nurseries.addtional.qualifications.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = array();
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
        }//end of for each

        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Qualification::findOrFail($id);
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
            Qualification::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Qualification::findOrFail($id);
        $returnHTML = view('dashboard.nurseries.addtional.qualifications.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $qualification = Qualification::findOrFail($request->id);
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
            $qualification->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $qualification = Qualification::findOrFail($id);
        $qualification->delete();
        return response()->json(array('success' => true));
    }
}
