<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index() {
        return view('guest.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->only(['user_id', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('show_top'));
        }

        return back()->withErrors([
            'message' => 'ユーザーIDまたはパスワードが正しくありません。',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
