<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->role === 'company' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $total_jobs = Job::where('user_id', $user->id)
                        ->where('status', '=', 'active')
                        ->get()->count();
        return ($user->role === 'company' && $total_jobs <3) || $user->role === 'admin';
    }
    public function store(User $user): bool
    {
        return $user->role === 'company' || $user->role === 'admin';
    }
    
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        return ($user->role === 'company' && $user->id === $job->user_id)
                || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        return ($user->role === 'company' && $user->id === $job->user_id) || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        return ($user->role === 'company' && $user->id === $job->user_id) || $user->role === 'admin';
    }
}
