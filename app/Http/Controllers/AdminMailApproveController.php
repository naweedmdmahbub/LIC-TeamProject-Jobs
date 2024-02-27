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
    public function userDraftStatus($draft)
    {
        $draft = User::findOrFail($draft);
        if ($draft->status === 'draft') {
            $status = Status::APPROVED;
            $draft->update([
                'status' => $status,
            ]);

            return back();
        }
    }
    /**
     * User Approve With Change Status
     */

    //  public function userApproveStatus($approve)
    //  {
    //         $approve = User::findOrFail($approve);
    //         if($approve->status){
    //             $approve->update([
    //                 'status' => Status::APPROVED
    //             ]);
    //             return back();
    //         }
    //  }
}
