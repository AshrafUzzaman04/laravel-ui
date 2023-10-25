<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\StudentsController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route("home");
});

Auth::routes();

//__class routes__//
Route::get('/class', [ClassController::class, 'index'])->middleware(['auth'])->name('class.index');
Route::get('/add-class', function () {
    return view("admin.add-class");
})->middleware(['auth'])->name('class.add');
Route::post('/class/create', [ClassController::class, 'create'])->middleware(['auth'])->name('class.create');
Route::delete('/class/destroy/{id}', [ClassController::class, 'destroy'])->middleware(['auth'])->name('class.destroy');
Route::get('/class-update/{id}', function ($id) {
    $class = DB::table("classes")->where("id", Crypt::decryptString($id))->first();
    return view("admin.class-update", compact("class"));
})->middleware(['auth'])->name('class.edit');
Route::put('/class/update/{id}', [ClassController::class, 'update'])->middleware(['auth'])->name('class.update');


//__students routes__//
Route::resource('students', StudentsController::class);


//__category routes__//
Route::resource('category', CategoryController::class);



//__admin routes__//
Route::get("/admin", function () {
    return view("welcome");
})->middleware("auth")->name("admin.view");






Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get("/deposit/money", [HomeController::class, 'deposit'])->middleware(["auth", "verified"])->name("deposit.money");

Route::get("/view/user/{id}", [HomeController::class, 'view'])->middleware(["auth"])->name("view.user");

Route::get("/change-password", [HomeController::class, 'change_password'])->middleware(["auth"])->name("change.password");

Route::post("/update-password", [HomeController::class, 'update_password'])->middleware(["auth"])->name("update.password");

//__varifiacation notice__//
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


//__verification resending__//
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [HomeController::class, 'index'])->name('home');
