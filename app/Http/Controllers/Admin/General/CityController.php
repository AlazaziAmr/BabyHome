<?php

namespace App\Http\Controllers\Admin\General;

use App\DataTables\Admin\General\CityDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index(CityDataTable $dataTable,Request $request){
        $data['title'] = __('site.cities');
        $data['icon'] = __('icon.cities');
        $data['countries'] = Country::all();
        return $dataTable->render('dashboard.cities.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = array();


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

            $request_data['country_id'] = $request->country_id;
            $request_data['name'] = [
                'ar' => $request->ar_name,
                'en' => $request->en_name,
            ];

            City::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = City::findOrFail($id);
        $data['countries'] = Country::all();
        $returnHTML = view('dashboard.cities.partials._edit',compact('form_data','data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $city = City::findOrFail($request->id);
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
            $request_data['country_id'] = $request->country_id;
            $city->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(array('success' => true));
    }
}
