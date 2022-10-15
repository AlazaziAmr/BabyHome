<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['title'] = __('site.home');
        $data['children'] = Child::count();
        $data['nurseries'] = Nursery::count();
        $data['latest_nurseries'] = Nursery::with('owner')->latest()->get()->take(5);
        $data['masters'] = Master::count();
        return view('dashboard.index', compact('data'));

    }
}
