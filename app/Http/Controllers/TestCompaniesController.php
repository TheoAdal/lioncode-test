<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TestCompanies;

class TestCompaniesController extends Controller
{
    public function form(Request $request)
    {
        return view('companies.form');
    }

    public function show(Request $request)
    {
        // return response()->json(TestCompanies::all());
        return response()->json(TestCompanies::select('name', 'adress', 'phone')->get());
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:5','max:225', 'string'],
            'adress' => ['required', 'min:5','max:225', 'string'],
            'phone' => ['required', 'min:8','max:15', 'string'],
        ]);

        TestCompanies::create($credentials);

        return response()->json(['credentials' => $credentials]);
        
        // return redirect()-> route ('');
       
    }
}

