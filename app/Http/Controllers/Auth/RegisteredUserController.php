<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Role;
use App\Http\Controllers\Controller;
use App\Jobs\AdminApproveSendMail;
use App\Jobs\ProcessPodcast;
use App\Mail\AdminApproveMail;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\CandidateInfo;
use App\Models\CompanyInfo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
       $roles = [
           Role::CANDIDATE,
           Role::COMPANY
       ];

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->role === 'candidate'){
            CandidateInfo::create([
                'experience' => $request->experience,
                'designation' => $request->designation,
                'address' => $request->address,
                'skill' => $request->skill,
                'user_id' => $user->id,
            ]);
        }

        if($request->role === 'company'){
            CompanyInfo::create([
                'website'   => $request->website,
                'contact'   => $request->contact,
                'location'  => $request->location,
                'user_id'    => $user->id
            ]);
            AdminApproveSendMail::dispatch($user);
            event(new Registered($user));
        }
        return redirect()->route('login');
    }
}
