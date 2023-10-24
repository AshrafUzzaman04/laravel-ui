<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    //__construct fucntion__//
    public function __construct()
    {
        $this->middleware(["auth"]);
    }

    public function index()
    {
        $class = DB::table("classes")->paginate(4);

        //__use any__//
        return view("admin.class", ['class' => $class]);
        // return view("admin.class", compact("class"));
    }

    public function create(Request $request)
    {
        $request->validate([
            "name" => "required|unique:classes,class_name",
        ]);

        $data = array(
            "class_name" => $request->name,
        );

        DB::table("classes")->insert($data);

        return redirect()->back()->with("success", "Class Added Successfully!");
    }

    public function destroy($id)
    {
        DB::table("classes")->where("id", Crypt::decryptString($id))->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $data = array(
            "class_name" => $request->name,
        );

        DB::table("classes")->where("id", Crypt::decryptString($id))->update($data);

        return redirect()->back()->with("success", "Class Updated successfully!");
    }
}
