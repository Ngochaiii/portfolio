<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index() {
        $compacts = [
        ];
        return view('source.web.pricing.index',$compacts);
    }
}
