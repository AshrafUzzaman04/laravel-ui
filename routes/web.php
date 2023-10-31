<?php

use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\StudentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\{Auth, Crypt, DB, Request, Route};

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

// Route::get("/", [HomeController::class, "demo"]);

Route::get("lang/{lang}", [LanguageController::class, "switchLang"]);

Route::get("reload-captcha", function () {
    return response()->json(['captcha' => captcha_img('flat')]);
})->name("reload.captcha");

Auth::routes();

//__class routes__//
Route::name("class.")->group(function () {
    Route::get('/class', [ClassController::class, 'index'])->name('index');
    Route::get('/add-class', function () {
        return view("admin.add-class");
    })->name('add');
    Route::post('/class/create', [ClassController::class, 'create'])->name('create');
    Route::delete('/class/destroy/{id}', [ClassController::class, 'destroy'])->name('destroy');
    Route::get('/class-update/{id}', function ($id) {
        $class = DB::table("classes")->where("id", Crypt::decryptString($id))->first();
        return view("admin.class-update", compact("class"));
    })->name('edit');
    Route::put('/class/update/{id}', [ClassController::class, 'update'])->name('update');
})->middleware("auth");

//__student routes__//
Route::resource('students', StudentsController::class);



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
