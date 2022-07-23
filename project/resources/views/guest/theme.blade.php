@extends('layouts.guest')

@section('title')
MCS - {{ $current_theme->name }}
@endsection

@section('content')

<div class="favorite_btn" style="display: flex; justify-content: space-between; align-items: center;">
    <h2>{{ $current_theme->name }}</h2>
    <a style="display: block; font-size: 20px;" href="{{ route('home') }}">戻る</a>
</div>

<form class="search" action="{{ route('public_search_record', $current_theme->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="text" placeholder="キーワード検索" name="keywords">
    <button>検索</button>
    @error('keywords')
    <span class="error">{{ $message }}</span>
    @enderror
</form>

<div class="csv_field">
    <button style="cursor: pointer;" onclick="window.location.href='{{ route('public_export_csv', $current_theme->id) }}'">CSVエクスポート</button>
</div>

<div class="cheat_sheet_table" style="width: 100%;">
    <table>
    <thead>
        <tr>
            <th class="explanation">コメント</th>
            <th class="url">url</th>
        </tr>
    </thead>
    @foreach ($records as $record)
    <tbody>
        <tr>
            <td class="explanation">{{ $record['explanation'] }}</td>
            <td class="url"><a target="_blank" href="{{ $record['url'] }}">{{ $record['url'] }}</a></td>
        </tr>
    </tbody>
    @endforeach
    </table>
</div>

<style>
    html {
        height: 100%;
        width: 100%;
    }
    .import_csv {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 999;
    }
    .import_csv form {
        background-color: #fff;
        width: 400px;
        margin: 0 auto;
        margin-top: 300px;
        padding: 30px;
        text-align: center;
        border-radius: 4px;
    }
    .import_csv form button {
        display: inline-block;
        width: 100px;
        height: 30px;
        margin-left: 5px;
        margin-right: 5px;
        margin-top: 40px;
        cursor: pointer;
    }
</style>

@endsection
