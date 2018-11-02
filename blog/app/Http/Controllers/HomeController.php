<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function allUsers()
    {
        dd('Access All Users');
    }

    public function adminSuperadmin()
    {
        dd('Access Admin and Superadmin');
    }

    public function superadmin()
    {
        dd('Access only Superadmin');
    }
}
