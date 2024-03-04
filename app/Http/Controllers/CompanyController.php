<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class CompanyController extends Controller
{
    public function index() 
    {
        $companies = User::with('companyInfo')->where('role', '=', 'company')->get();
        return view('companies.index', compact('companies'));
    }
}
