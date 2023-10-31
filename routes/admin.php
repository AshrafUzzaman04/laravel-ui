<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\StudentsController;
use App\Http\Controllers\admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

//__admin routes__//
Route::middleware(["auth", "is_admin"])->group(function () {
    Route::get("/dashboard", function () {
        return view("welcome");
    })->name("admin.view");

    //__category routes__//
    Route::resource('category', CategoryController::class);

    //__sub categories routes__//
    Route::resource("sub-categories", SubCategoryController::class);

    //__post all routes__//
    Route::resource("post", PostController::class);
});
