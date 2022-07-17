<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Presenters\ThemePresenter;
use App\Models\Cheatsheet;
use App\Models\Themes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index($theme_id, ThemePresenter $presenter) {
        $data['current_theme'] = $presenter->add_theme($theme_id);
        $data['user_id'] = Auth::user()->user_id;
        $data['themes'] = $presenter->add_themes();
        $data['records'] = $presenter->add_records($theme_id);

        return view('user.theme', $data);
    }

    public function favorite($theme_id, Request $request) {
        Themes::_add_favorite($theme_id, $request);
        return redirect(route('show_theme', $theme_id));
    }

    public function add(Request $request, $theme_id) {
        $request->validate([
            'explanation' => 'required'
        ]);
        Cheatsheet::_create($request, $theme_id);
        return redirect(route('show_theme', $theme_id));
    }

    public function delete($theme_id) {
        Cheatsheet::_delete($theme_id);
        return redirect(route('show_theme', $theme_id));
    }

    public function update($theme_id, $record_id, Request $request) {
        $request->validate([
            'explanation' => 'required'
        ]);
        Cheatsheet::_update($request, $record_id);
        return redirect(route('show_theme', $theme_id));
    }

    public function show_update($theme_id, $record_id, ThemePresenter $presenter) {
        $data['current_theme'] = $presenter->add_theme($theme_id);
        $data['user_id'] = Auth::user()->user_id;
        $data['update_record'] = $presenter->update_record($record_id);
        $data['themes'] = $presenter->add_themes();
        return view('user.theme_update', $data);
    }

    public function search($theme_id, Request $request, ThemePresenter $presenter) {
        $request->validate([
            'keywords' => 'required'
        ]);
        $data['current_theme'] = $presenter->add_theme($theme_id);
        $data['user_id'] = Auth::user()->user_id;
        $data['themes'] = $presenter->add_themes();
        $data['records'] = $presenter->search_record($request, $theme_id);
        return view('user.theme', $data);
    }

    public function export_csv($theme_id) {
        $file_path = "./../../../..".'/tmp/'.date('YmdHis').'-'.mt_rand().'.csv';
        $fp = fopen($file_path, 'w');

        $header = ['comment', 'url'];
        fputcsv($fp, $header);

        $data = Cheatsheet::where('theme_id', $theme_id)->get()->toArray();
        foreach ($data as $array) {
            $body = [];
            $body['comment'] = $array['explanation'];
            $body['url'] = $array['url'];
            mb_convert_variables('SJIS', 'UTF-8', $body);

            fputcsv($fp, $body);
        }
        fclose($fp);

        $file_name = date('YmdHis').'-'.$theme_id.'.csv';

        header('Content-Type: application/octet-stream');

        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Content-Length: ' . filesize($file_path));
        header('Content-Transfer-Encoding: binary');
        readfile($file_path);
    }
}
