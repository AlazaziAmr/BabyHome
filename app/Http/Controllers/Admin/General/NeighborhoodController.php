<?php

namespace App\Http\Controllers\Admin\General;

use App\DataTables\Admin\General\NeighborhoodDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
                    $name_array['en'] = $sheet->getCell('C' . $row)->getValue();
                    $name_array['ar'] = $sheet->getCell('B' . $row)->getValue();

                    $city = City::where('name->ar','LIKE','%'.$sheet->getCell('A' . $row)->getValue().'%')
                        ->first();
                    $city_id = $city->id;
                    if(!$city){
                       $new_city =  City::create([
                            'name' => [
                                'ar' => $sheet->getCell('A' . $row)->getValue(),
                                'en' => '',
                            ],
                            'country_id' => 1
                        ]);
                        $city_id = $new_city->id;
                    }
                    $request_data['name'] = [
                        'ar' => $name_array['ar'],
                        'en' => $name_array['en'],
                    ];
                    $neighborhod = Neighborhood::where('name->en','LIKE','%'.$name_array['en'].'%')
                        ->where('name->ar','LIKE','%'.$name_array['ar'].'%')->first();
                    if(!$neighborhod){
                        $request_data += ['city_id' => $city_id];
                        Neighborhood::create($request_data);
                    }
                }
                $startcount++;
            }
        } catch (\Exception $e) {
//            $error_code = $e->errorInfo[1];
//            echo json_encode($e);
//            return back()->withErrors('There was a problem uploading the data!');
        }

        return response()->json(array('success' => true), 200);
    }

}
