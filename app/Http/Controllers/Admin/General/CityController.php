<?php

namespace App\Http\Controllers\Admin\General;

use App\DataTables\Admin\General\CityDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CityController extends Controller
{
    public function index(CityDataTable $dataTable,Request $request){
        $data['title'] = __('site.cities');
        $data['icon'] = __('icon.cities');
        $data['countries'] = Country::all();
        return $dataTable->render('dashboard.general.cities.index',compact('data'));
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
            $request_data['country_id'] = 1;
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
        $returnHTML = view('dashboard.general.cities.partials._edit',compact('form_data','data'))->render();
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
//            $request_data['country_id'] = $request->country_id;
            $request_data['country_id'] = 1;
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

    public function store_excel(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                if( $sheet->getCell('A' . $row)->getValue()){
                    $name_array['en'] = $sheet->getCell('B' . $row)->getValue();
                    $name_array['ar'] = $sheet->getCell('A' . $row)->getValue();

                    $request_data['name'] = [
                        'ar' => $name_array['ar'],
                        'en' => $name_array['en'],
                    ];
//            $request_data['country_id'] = $request->country_id;
                    $request_data['country_id'] = 1;
                    $city = City::where('name->en','LIKE','%'.$name_array['en'].'%')
                        ->where('name->ar','LIKE','%'.$name_array['ar'].'%')->first();
                    if(!$city){
                        City::create($request_data);
                    }
                }
                $startcount++;
            }
        } catch (\Exception $e) {
            $error_code = $e->errorInfo[1];
//            return back()->withErrors('There was a problem uploading the data!');
        }

        return response()->json(array('success' => true), 200);
    }
}
