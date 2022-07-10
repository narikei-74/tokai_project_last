<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cheatsheet extends Model
{
    use HasFactory;

    protected $table = 'cheatsheet';

    protected $fillable = [
        'theme_id',
        'user_id',
        'explanation',
        'url'
    ];

    public static function _create($request, $theme_id) {
        $cheat_sheet = new Cheatsheet();
        $cheat_sheet->theme_id = $theme_id;
        $cheat_sheet->user_id = Auth::user()->user_id;
        $cheat_sheet->explanation = $request->explanation;
        $cheat_sheet->url = $request->url;
        $cheat_sheet->save();
    }

    public static function _delete($record_id) {
        $cheat_sheet = Cheatsheet::where('id', $record_id)->where('user_id', Auth::user()->user_id)->first();
        if ($cheat_sheet) {
            $cheat_sheet->delete();
        }
    }

    public static function _update($request, $record_id) {
        $cheat_sheet = Cheatsheet::where('id', $record_id)->where('user_id', Auth::user()->user_id)->first();
        if ($cheat_sheet) {
            $cheat_sheet->explanation = $request->explanation;
            $cheat_sheet->url = $request->url;
            $cheat_sheet->save();
        }
    }

    public static function _search($request, $theme_id) {
        $keywords = $request->keywords;
        $keywords = preg_split('/(　| )+/', $keywords);
        $records = [];
        foreach ($keywords as $key => $keyword) {
            if ($keyword != '') {
                $record = Cheatsheet::where('user_id', Auth::user()->user_id)->where('theme_id', $theme_id)->where('explanation', 'LIKE', '%'.$keyword.'%')->get()->toArray();
                $record = reset($record);
                if ($record) {
                    $records[$key] = $record;
                }
            }
        }
        return $records;
    }
}
