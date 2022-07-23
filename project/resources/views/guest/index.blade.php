@extends('layouts.guest')

@section('title')
MCS - home
@endsection

@section('content')
<h2>公開カテゴリー</h2>
<ul class="theme_grid">
    @if (@$themes)
        @foreach ($themes as $theme)
            <li class="theme_recode">
                <a href="{{ route('public_theme', $theme['id']) }}">{{ $theme['name'] }}</a>
            </li>
        @endforeach
    @endif
</ul>

<style>
    .theme_delete_button {
        display: inline-block;
        position: relative;
        top: 5px;
        margin-left: 5px;
        cursor: pointer;
    }
    .theme_delete_button:hover {
        opacity: .4;
    }
    .theme_delete {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 999;
    }
    .theme_delete form {
        background-color: #fff;
        width: 400px;
        margin: 0 auto;
        margin-top: 300px;
        padding: 30px;
        text-align: center;
        border-radius: 4px;
    }
    .theme_delete form button {
        display: inline-block;
        width: 100px;
        height: 30px;
        margin-left: 5px;
        margin-right: 5px;
        margin-top: 20px;
        cursor: pointer;
    }
</style>
@endsection


