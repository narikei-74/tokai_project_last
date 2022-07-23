@extends('layouts.guest')

@section('title')
MCS - home
@endsection

@section('content')
<div class="private-content">
    <div class="private">
        <h1 class="title">My Cheat Sheet</h1>
        <div class="btns">
            <a href="{{ route('show_login') }}" class="login">ログイン</a>
            <a href="{{ route('show_register') }}" class="register">新規登録</a>
        </div>
        <a style="font-size: 20px;" href="{{ route('home') }}">戻る</a>
    </div>
</div>
@endsection


