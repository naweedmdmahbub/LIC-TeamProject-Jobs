<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     *  Show Home Page
     */
    public function home()
    {

        return view('index');
    }
}
