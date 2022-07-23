@extends('layouts.guest')

@section('title')
MCS - 登録完了
@endsection

@section('content')
<div class="private-content">
    <div class="private">
        <h1 class="login-title">{{ $user->user_id }}さん登録完了</h1>
        <a href="{{ route('show_login') }}" class="back">ログイン画面へ</a>
    </div>
</div>
@endsection
