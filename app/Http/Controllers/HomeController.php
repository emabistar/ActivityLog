<?php

namespace App\Http\Controllers;

use App\Project;
use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalTime = DB::select('SELECT id,start,end, SUM(TIMESTAMPDIFF(SECOND,start,end)) AS totalsecond  FROM entries ')  ;
        $projects = Project::with('entries')->get();
        return view('home', ['projects' => $projects,'totaltimes'=>$totalTime]);
    }

    
    

}
