<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $tickets = Tickets::whereHas('people')
        ->where('status', '=', 'a')
        ->where('created_at','like', '%'. date('y-m-d') .'%')->paginate();
        return view('welcome', compact('tickets'));
    }
}
