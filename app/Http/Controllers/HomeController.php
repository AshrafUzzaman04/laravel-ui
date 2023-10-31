<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Cache, Crypt, Hash};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function demo()
    {
        $hellow = "hellow";
        Cache::put("hellow", $hellow);
        Cache::flush();
        dd(Cache::get("hellow"));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function deposit()
    {
        return view("deposit");
    }

    public function view($id)
    {
        echo Crypt::decryptString($id);
        echo "<br/>";
        echo Hash::make("123");
    }

    public function change_password()
    {
        return view("change-password");
    }

    public function update_password(Request $request)
    {
        $request->validate([
            "current_password" => "required",
            "password" => "required|min:6|max:16|confirmed",
            "password_confirmation" => "required"
        ]);

        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save;
            Auth::logout();
            return redirect()->route("login");
        } else {
            return redirect()->back()->with("error", "Old Password Error!");
        }
    }
}
