@extends('layouts.guest')

@section('title')
MCS - 新規登録
@endsection

@section('content')
<div class="private-content">
    <div class="private">
        <h1 class="login-title">新規登録</h1>
        <form class="login-form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <input type="text" name="user_id" placeholder="ユーザーID"/>
            @error('user_id')
            <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="パスワード"/>
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password_confirmation" placeholder="パスワードの確認"/>

            <button class="login" style="width: 160px; padding: 6px 0; font-size: 16px;">登録</button>
        </form>
        <a href="{{ route('show_private') }}" class="back">戻る</a>
    </div>
</div>
@endsection
