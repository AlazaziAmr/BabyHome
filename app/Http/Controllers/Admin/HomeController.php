<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['title'] = __('site.home');
        return view('dashboard.index', compact('data'));

    }
}
