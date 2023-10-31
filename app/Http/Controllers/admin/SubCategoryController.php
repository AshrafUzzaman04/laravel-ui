<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, sub_category};
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Crypt, Cache};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $sub_categories =  DB::table("sub_categories")->leftJoin("categories", "sub_categories.cat_id", "categories.id")->select("categories.category_name", "sub_categories.*")->get();

        $sub_categories = Cache::remember("sub_categories", 15, function () {
            return sub_category::all();
        });

        // return response()->json($sub_categories);
        return view("admin.sub-category.all-sub-category", compact("sub_categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.sub-category.add-sub-category", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:2",
            "selectedCatForSubCat" => "required",
        ]);

        sub_category::create([
            "sub_catname" => $request->name,
            "sub_catslug" => Str::slug($request->name),
            "cat_id" => $request->selectedCatForSubCat,
        ]);

        Toastr::success("Sub Category successfully created", "Congratulations");
        return redirect()->back();
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
        $categories = Category::select("id", "category_name")->get();
        $get_subCat = sub_category::find(Crypt::decryptString($id));
        return view("admin.sub-category.edit-sub-category", compact('get_subCat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "selectedCatForSubCat" => "required",
        ]);

        sub_category::where("id", Crypt::decryptString($id))->update([
            "sub_catname" => $request->name,
            "sub_catslug" => Str::slug($request->name),
            "cat_id" => $request->selectedCatForSubCat
        ]);

        Toastr::success("Sub Category successfully Updated", "Updated");
        return redirect()->route("sub-categories.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sub_category::destroy(Crypt::decryptString($id));
        Toastr::error("Sub Category successfully deleted", "Deleted");
        return redirect()->back();
    }
}
