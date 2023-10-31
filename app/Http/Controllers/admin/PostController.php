<?php

namespace App\Http\Controllers\admin;

use App\Events\PostProcessed;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

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
            "title" => "required|string|unique:posts",
            "description" => "required",
            "postImg" => "required|image|mimes:jpeg,png,jpg|max:2048", //max 2MB
        ]);

        $photo = $request->postImg;
        $image = Str::slug($request->title) . "." . $photo->getClientOriginalExtension();
        $moveImg  = public_path("assets/image/post/" . $image);
        Image::make($photo)->fit(80, 80)->save($moveImg);

        //__event calling__//
        $edata = ["title" => $request->title, "date" => date("d F, Y")];
        event(new PostProcessed($edata));

        Post::create([
            "cat_id" => $request->selectCatForPost,
            "subcat_id" => $request->selectSubCatForPost,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "post_image" => "assets/image/post/" . $image,
            "description" => $request->description,
            "status" => ($request->status),
        ]);

        // dd($post);

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
            "postImg" => "image|mimes:png,jpg,jpeg|max:2048",
            "description" => "required",
        ]);

        $photo = $request->postImg;
        $status = ($request->status) ?? 0;
        if ($photo) {
            if (File::exists(public_path("$request->old_image"))) {
                File::delete(public_path("$request->old_image"));
            }
            $image = Str::slug($request->title) . "." . $photo->getClientOriginalExtension();
            $moveImg  = public_path("assets/image/post/" . $image);
            Image::make($photo)->fit(80, 80)->save($moveImg);

            Post::where("id", Crypt::decryptString($id))->update([
                "cat_id" => $request->selectCatForPost,
                "subcat_id" => $request->selectSubCatForPost,
                "user_id" => Auth::id(),
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "description" => $request->description,
                "post_image" => "assets/image/post/" . $image,
                "status" => $status,
            ]);
        }

        Post::where("id", Crypt::decryptString($id))->update([
            "cat_id" => $request->selectCatForPost,
            "subcat_id" => $request->selectSubCatForPost,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "status" => $status,
        ]);

        Toastr::success("Post successfully Updated!", "Congratulations!");
        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Post::where("id", Crypt::decryptString($id))->select("post_image")->first();
        if (File::exists(public_path($image->post_image))) {
            File::delete(public_path($image->post_image));
        }
        Post::destroy(Crypt::decryptString($id));

        Toastr::error("Category Deleted Successfully!", "Warning!");
        return redirect()->back();
    }
}
