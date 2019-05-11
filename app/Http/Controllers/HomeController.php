<?php

namespace App\Http\Controllers;

use Debugbar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        return view('index', ['ver' => 'aaa']);
    }
}
