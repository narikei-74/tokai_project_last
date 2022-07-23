<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Presenters\ThemePresenter;
use App\Models\Cheatsheet;
use App\Models\Themes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data['themes'] = Themes::_get_public_theme();
        return view('guest.index', $data);
    }

    public function theme($theme_id, ThemePresenter $presenter) {
        $data['current_theme'] = $presenter->add_public_theme($theme_id);
        $data['records'] = $presenter->add_public_records($theme_id);

        return view('guest.theme', $data);
    }

    public function search($theme_id, Request $request, ThemePresenter $presenter) {
        if ($request['keywords'] == "") {
            return redirect(route('public_theme', $theme_id));
        }
        $data['current_theme'] = $presenter->add_public_theme($theme_id);
        $data['records'] = $presenter->search_public_record($request, $theme_id);
        return view('guest.theme', $data);
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
