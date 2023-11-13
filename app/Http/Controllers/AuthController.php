<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_index() {
        return view('auth.login');
    }

    public function login_store(Request $request) {
        $body = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (Auth::attempt($body)) {
            return redirect()->route('index')->with('success', 'Anda berhasil login');
        } else {
            return back()->with('error', 'Username atau password anda salah!');
        }
    }

    public function register_index() {
        return view('auth.register');
    }

    public function register_store(Request $request) {
        $request->validate([
            "name" => "required|string|min:3|max:255",
            "password" => "required|string|min:8|confirmed"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login.index')->with("success", "Berhasil membuat akun, silakan login dengan benar!");

    }

    public function logout(Request $request) {

        Auth::logout();
        return redirect()->route('login.index');

    }
}
