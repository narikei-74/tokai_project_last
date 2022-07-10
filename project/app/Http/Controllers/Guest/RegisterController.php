<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        return view('guest.register');
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'user_id' => $request->user_id,
            'password' => Hash::make($request->password),
            // 'html' => '0',
            // 'css' => '0',
            // 'git' => '0',
            // 'docker' => '0',
            // 'linuxコマンド' => '0',
            // '変数名' => '0',
            // 'メソッド名' => '0',
            // 'コメント' => '0',
        ]);

        return view('guest.regist_complete', compact('user'));
    }
}
