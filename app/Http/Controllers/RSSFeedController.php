<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Job;
  
class RSSFeedController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $jobs = Job::latest()->get();
  
        return response()->view('rss', [
            'jobs' => $jobs
        ])->header('Content-Type', 'text/xml');
    }
}