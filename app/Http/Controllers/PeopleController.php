<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index(){
        return view('people.index');
    }

    public function getPeople(Request $request){
        $data = People::orWhere(function($q) use ($request){
            $q->where('name', 'like', '%'.$request->searchItem.'%')
            ->orWhere('lastname', 'like', '%'.$request->searchItem.'%')
            ->orWhere('id_card', 'like', '%'.$request->searchItem.'%');
        })->get();

        return response()->json(['data' => $data]);
    }
}
