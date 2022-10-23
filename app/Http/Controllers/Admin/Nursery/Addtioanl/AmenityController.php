<?php

namespace App\Http\Controllers\Admin\Nursery\Addtioanl;

use App\DataTables\Admin\Nursery\Adtional\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AmenityController extends Controller
{
    public function index(AmenityDataTable $dataTable,Request $request){
        $data['title'] = __('site.amenities');
        $data['icon'] = __('icon.amenities');
        return $dataTable->render('dashboard.nurseries.addtional.amenities.index',compact('data'));
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
        $form_data = Amenity::findOrFail($id);
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
            $request_data['is_required']  = ($request->is_required) ? 1 : 0;
            Amenity::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Amenity::findOrFail($id);
        $returnHTML = view('dashboard.nurseries.addtional.amenities.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $amenity = Amenity::findOrFail($request->id);
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
            $request_data['is_required']  = ($request->is_required) ? 1 : 0;
            $amenity->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();
        return response()->json(array('success' => true));
    }
}
