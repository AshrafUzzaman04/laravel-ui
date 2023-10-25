<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\student;
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
        // $students = DB::table("students")->get();
        $students = student::all();
        return view("admin.student.all-student", compact("students"));
        // dd($students);
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
        $decryptedId = Crypt::decryptString($id);
        $classes = DB::table("classes")->get();
        $students = DB::table('students')->where("id", $decryptedId)->first();
        return view("admin.student.edit-student", compact("students", "classes"));
        // dd($student);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decrypt = Crypt::decryptString($id);
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required|max:11",
            "roll" => "required|alpha_num|min:1",
            "class_id" => "required",
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->number,
            "roll" => $request->roll,
            "class_id" => $request->class_id,
        ];

        DB::table("students")->where("id", $decrypt)->update($data);

        return redirect()->route("students.index")->with("status", "Student Updated Successfully!");
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
