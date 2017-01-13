<?php

namespace App\Http\Controllers;

use DB;
use App\Department;
use App\Section;
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
        $departments = Department::orderBy('name','asc')->get();
        $sections = Section::all();
        return view('home', compact('departments', 'sections'));
    }
}
