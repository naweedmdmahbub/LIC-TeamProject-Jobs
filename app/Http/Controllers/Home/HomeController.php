<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     *  Show Home Page
     */
    public function home()
    {
        return view('index');
    }

    public function welcome()
    {
        $jobs = Job::where('status', '=', 'active')->get();
        $tags = Tag::all();
        return view('welcome', compact('jobs', 'tags'));
    }
}
