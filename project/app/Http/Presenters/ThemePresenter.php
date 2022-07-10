<?php

namespace App\Http\Presenters;

use App\Http\Presenters\Presenter;
use App\Models\Cheatsheet;
use App\Models\Themes;
use Illuminate\Support\Facades\Auth;

class ThemePresenter extends Presenter
{
    public function add_records($theme_id) {
        $cheat_sheet = Cheatsheet::where('theme_id', $theme_id)->where('user_id', Auth::user()->user_id)->orderBy('id', 'desc')->get();
        return $cheat_sheet;
    }

    public function add_theme($theme_id) {
        $theme = Themes::where('user_id', Auth::user()->user_id)->where('id', $theme_id)->get()->first();
        return $theme;
    }


    public function update_record($record_id) {
        $cheat_sheet = Cheatsheet::where('id', $record_id)->where('user_id', Auth::user()->user_id)->first();
        return $cheat_sheet;
    }

    public function search_record($request, $theme_id) {
        $records = Cheatsheet::_search($request, $theme_id);
        return $records;
    }

    public function add_themes() {
        $themes = Themes::where('user_id', Auth::user()->user_id)->get()->toArray();
        return $themes;
    }
}

