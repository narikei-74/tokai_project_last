<?php

namespace App\Http\Presenters;

use App\Http\Presenters\Presenter;
use App\Models\Themes;
use Illuminate\Support\Facades\Auth;

class TopPresenter extends Presenter
{
    public function add_themes() {
        $themes = Themes::where('user_id', Auth::user()->user_id)->get()->toArray();
        return $themes;
    }
}
