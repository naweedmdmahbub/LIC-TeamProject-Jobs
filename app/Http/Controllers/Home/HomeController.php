<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     *  Show Home Page
     */
    public function home()
    {
        return view('index');
    }

    public function welcome(Request $request)
    {
        $salary_min = $request['salary_min'];
        $salary_max = $request['salary_max'];
        $location = $request['location'];
        $jobs = Job::where('status', '=', 'active')
                    ->when($salary_min, function ($query) use ($salary_min) {
                        $query->where('salary_max', '>=', $salary_min);
                    })
                    ->when($salary_max, function ($query) use ($salary_max) {
                        $query->where('salary_min', '<=', $salary_max);
                    })
                    ->when($location, function ($query) use ($location) {
                        $query->whereHas('company', function($query) use ($location) {
                            $query->whereHas('companyInfo', function($query) use ($location) {
                                $query->where('location', 'like', '%' . $location . '%');
                            });
                        });
                    })
                    ->when($request->has('tags'), function ($query) use ($request) {
                        $query->whereHas('tags', function ($query) use ($request) {
                            $query->whereIn('id', $request['tags']);
                        });
                    })
                    ->get();

        $tags = Tag::all();
        return view('welcome', compact('jobs', 'tags'));
    }
}
