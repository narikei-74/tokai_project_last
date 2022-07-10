@extends('layouts.guest')

@section('title')
MCS - ログイン
@endsection

@section('content')
<h1 class="login-title">ログイン</h1>
<form class="login-form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    @foreach ($errors->all() as $error)
    <span class="error">{{ $error }}</span>
    @endforeach
    <input type="text" name="user_id" placeholder="ユーザーID"/>
    <input type="password" name="password" placeholder="パスワード"/>
    <button class="login" style="width: 160px; padding: 6px 0; font-size: 16px;">ログイン</button>
</form>
<a href="{{ route('home') }}" class="back">戻る</a>
@endsection
