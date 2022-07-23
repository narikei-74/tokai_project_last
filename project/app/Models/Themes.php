<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Themes extends Model
{
    use HasFactory;

    protected $table = 'themes';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'favorite'
    ];

    public static function _add_favorite($theme_id, $request) {
        $theme = Themes::where('user_id', Auth::user()->user_id)->where('id', $theme_id)->first();
        if ($theme) {
            $theme->favorite = $request->favorite;
            $theme->save();
        }
    }

    public static function _create_theme($theme_name) {
        $theme = new Themes();
        $theme->name = $theme_name;
        $theme->user_id = Auth::user()->user_id;
        $theme->favorite = 0;
        $theme->save();
    }

    public static function _delete_theme($theme_id) {
        Themes::where('id', $theme_id)->delete();
    }

    public static function _get_public_theme() {
        $themes = Themes::where('public', 1)->get()->toArray();
        return $themes;
    }

    public static function _do_public($theme_id) {
        $themes = Themes::where('id', $theme_id)->first();
        $themes->public = 1;
        $themes->save();
    }

    public static function _do_private($theme_id) {
        $themes = Themes::where('id', $theme_id)->first();
        $themes->public = 0;
        $themes->save();
    }
}
