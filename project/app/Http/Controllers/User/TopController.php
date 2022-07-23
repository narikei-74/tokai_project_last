<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Presenters\TopPresenter;
use App\Models\Themes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(TopPresenter $presenter) {
        $data['user_id'] = Auth::user()->user_id;
        $data['themes'] = $presenter->add_themes();
        return view('user.top', $data);
    }

    public function create_theme(Request $request) {
        $request->validate([
            'theme_name' => 'required'
        ]);
        Themes::_create_theme($request->theme_name);
        return redirect(route('show_top'));
    }

    public function delete_theme(Request $request) {
        Themes::_delete_theme($request->theme_id);
        return redirect(route('show_top'));
    }
}
