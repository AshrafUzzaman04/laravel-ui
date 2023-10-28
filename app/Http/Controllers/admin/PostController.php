<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\sub_category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
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
        $posts = Post::all();
        // $posts =  DB::table("posts")
        //     ->join("categories", "posts.cat_id", "categories.id")
        //     ->join("sub_categories", "posts.subcat_id", "sub_categories.id")
        //     ->join("users", "posts.user_id", "users.id")
        //     ->select("posts.*", "categories.category_name", "sub_categories.sub_catname as sub_catname")
        //     ->get();
        // return response()->json($posts);
        return view("admin.post.all-post", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =  Category::select("id", "category_name")->get();
        $subCategoires = sub_category::select("id", "sub_catname")->get();
        return view("admin.post.add-post", compact("categories", "subCategoires"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "selectCatForPost" => "required",
            "selectSubCatForPost" => "required",
            "title" => "required|string",
            "description" => "required"
        ]);

        Post::create([
            "cat_id" => $request->selectCatForPost,
            "subcat_id" => $request->selectSubCatForPost,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
        ]);

        Toastr::success("Post created successfully", "Congratulations!");
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
        $subCategories = sub_category::select("id", "sub_catname")->get();
        $post =  Post::where("id", Crypt::decryptString($id))->first();
        return view("admin.post.edit-post", compact("post", "categories", "subCategories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "selectCatForPost" => "required",
            "selectSubCatForPost" => "required",
            "title" => "required|string",
            "description" => "required"
        ]);

        Post::where("id", Crypt::decryptString($id))->update([
            "cat_id" => $request->selectCatForPost,
            "subcat_id" => $request->selectSubCatForPost,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
        ]);

        Toastr::success("Post successfully Updated!", "Congratulations!");
        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Post::find(Crypt::decryptString($id));
        Post::destroy(Crypt::decryptString($id));

        Toastr::error("Category Deleted Successfully!", "Warning!");
        return redirect()->back();
    }
}
