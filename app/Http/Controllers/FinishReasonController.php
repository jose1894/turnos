<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinishReasonController extends Controller
{
    public function index(){
        return view('finish-reasons.index');
    }
}
