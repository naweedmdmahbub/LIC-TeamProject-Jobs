<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\User;

class CompanyController extends Controller
{
    public function index() 
    {
        $companies = User::with('companyInfo')->where('role', '=', 'company')->get();
        return view('companies.index', compact('companies'));
    }

    /**
     * User Draft With Change Status
     */
    public function draftCompanyStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => Status::APPROVED,
        ]);
        return back();
    }

    /**
     * User Draft With Change Status
     */
    public function approveCompanyStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => Status::DRAFT,
        ]);
        return back();
    }
}
