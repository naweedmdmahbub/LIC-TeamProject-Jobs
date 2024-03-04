<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\User;

class AdminMailApproveController extends Controller
{
    /**
     *  Show Admin Approve Mail page
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin_approve.index', compact('users'));
    }

    /**
     * User Draft With Change Status
     */
    public function userDraftStatus($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->status === 'draft') {
            $status = Status::APPROVED;
            $user->update([
                'status' => $status,
            ]);

            return back();
        }
    }

    /**
     * User Approve With Change Status
     */
    public function approveCompanyFromEmail($user_id)
    {
        
        $user = User::findOrFail($user_id);
        if ($user->status === 'draft') {
            $status = Status::APPROVED;
            $user->update([
                'status' => $status,
            ]);

            return redirect('/companies');
        }
    }
    
}
