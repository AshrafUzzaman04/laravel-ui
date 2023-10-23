<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    //__construct fucntion__//
    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
    }

    public function index()
    {
        $class = DB::table("classes")->get();

        //__use any__//
        return view("admin.class", ['class' => $class]);
        // return view("admin.class", compact("class"));
    }
}
