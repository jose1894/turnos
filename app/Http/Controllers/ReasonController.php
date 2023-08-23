<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReasonController extends Controller
{
    public function index(){
        return view('reasons.index');
    }
}
