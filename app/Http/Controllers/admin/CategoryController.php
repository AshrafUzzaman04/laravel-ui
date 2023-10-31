<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\{Cache, Crypt};

class CategoryController extends Controller
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
        $categories = Cache::remember("categories", 15, function () {
            return Category::all();
        });
        return view("admin.category.all-category", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.category.add-category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:categories,category_name|min:2",
        ]);

        // $category->category_name = $request->name;
        // $category->category_slug = Str::slug($request->name, '-');
        // $category->save();


        Category::create([
            "category_name" => $request->name,
            "category_slug" => Str::slug($request->name, '-'),
        ]);

        Toastr::success($request->name . ' Category Inserted Successfully', 'Congratulations', ["positionClass" => "toast-top-right"]);
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
        $categories =  Category::find(Crypt::decryptString($id));
        return view("admin.category.edit-category", compact("categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        Category::where('id', Crypt::decryptString($id))
            ->update([
                "category_name" => $request->name,
                "category_slug" => Str::slug($request->name, "-"),
            ]);

        // $category =  Category::find(Crypt::decryptString($id));
        // $category->category_name = $request->name;
        // $category->category_slug = Str::slug($request->name, "-");
        // $category->save();

        Toastr::success('Category Updated Successfully', 'Congratulations', ["positionClass" => "toast-top-right", "progressBar" => true]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Category::where("id", Crypt::decryptString($id))->delete();

        // $category = Category::find(Crypt::decryptString($id));
        // $category->delete();

        $selct_category =  Category::where("id", Crypt::decryptString($id))->first();

        Category::destroy(Crypt::decryptString($id));

        // DB::table("categories")->where("id", Crypt::decryptString($id))->delete();

        Toastr::error($selct_category->category_name . ' Category Deleted Successfully', 'Congratulations', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
