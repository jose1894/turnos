<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    //
    public function index(){
        return view('tickets.index');
    }

    public function attention(){
        return view('tickets.attention');
    }
}
