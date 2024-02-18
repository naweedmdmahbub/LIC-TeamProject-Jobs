<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Constants\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CandidateInfo;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Jobs\AdminApproveSendMail;
use App\Jobs\ProcessPodcast;
use App\Mail\AdminApproveMail;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
       $roles = [
           Role::CANDIDATES,
           Role::COMPANY
       ];

        return view('auth.register',compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'role' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        if($request->role === 'candidate'){
            $request->validate([
                'experience' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'skill' => ['required', 'string', 'max:255'],
            ]);

          $candidates = CandidateInfo::create([
                'experience' => $request->experience,
                'designation' => $request->designation,
                'address'    => $request->address,
                'skill'      => $request->skill,
                'user_id'    => $user->id
            ]);
        }

        if($request->role === 'company'){
            $request->validate([
                'website' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:255'],
            ]);
          $company = CompanyInfo::create([
                'website'   => $request->website,
                'contact'   => $request->contact,
                'location'  => $request->location,
                'user_id'    => $user->id
            ]);
        }

        AdminApproveSendMail::dispatch($user);
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('login');
    }
}
