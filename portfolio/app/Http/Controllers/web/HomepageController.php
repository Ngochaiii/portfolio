<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{

    public function index() {
        $compacts = [
        ];
        return view('source.web.homepage.homepage',$compacts);
    }
    public function detail() {
        $compacts = [
        ];
        return view('source.web.homepage.detail',$compacts);
    }
}
