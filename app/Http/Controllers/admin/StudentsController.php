<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $students = DB::table('students')->orderBy('roll', 'ASC')->get();
        return view("admin.student.all-student", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes =  DB::table("classes")->get();
        return view("admin.student.add-student", compact("classes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:students,email",
            "number" => "required|unique:students,mobile",
            "roll" => "required|alpha_num|min:1|unique:students,roll",
            "class_id" => "required",
        ]);

        $data = array([
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->number,
            "roll" => $request->roll,
            "class_id" => $request->class_id,
        ]);

        DB::table("students")->insert($data);

        return redirect()->route("students.index")->with("status", "Student Added Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('students')->where("id", Crypt::decryptString($id))->delete();

        return redirect()->back()->with("status", "Student Deleted Successfully!");
    }
}
