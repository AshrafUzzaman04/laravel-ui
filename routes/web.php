<?php

use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

//__class routes__//
Route::get('/class', [ClassController::class, 'index'])->middleware(['auth', 'verified'])->name('class.index');















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
