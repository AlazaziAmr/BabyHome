<?php

namespace App\Http\Controllers\Admin\General;

use App\DataTables\Admin\General\NeighborhoodDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NeighborhoodController extends Controller
{
    public function index(NeighborhoodDataTable $dataTable,Request $request){
        $data['title'] = __('site.neighborhoods');
        $data['icon'] = __('icon.neighborhoods');
        $data['cities'] = City::all();
        return $dataTable->render('dashboard.general.neighborhoods.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = [
            'city_id' => 'required'
        ];
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
        }//end of for each

        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = City::findOrFail($id);
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

//            $request_data['country_id'] = $request->country_id;
            $request_data['city_id'] = $request->city_id;
            $request_data['name'] = [
                'ar' => $request->ar_name,
                'en' => $request->en_name,
            ];

            Neighborhood::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Neighborhood::findOrFail($id);
        $data['cities'] = City::all();
        $returnHTML = view('dashboard.general.neighborhoods.partials._edit',compact('form_data','data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $neighborhood = Neighborhood::findOrFail($request->id);
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
//            $request_data['country_id'] = $request->country_id;
            $request_data['city_id'] = 1;
            $neighborhood->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $neighborhood = Neighborhood::findOrFail($id);
        $neighborhood->delete();
        return response()->json(array('success' => true));
    }
}
