@extends('layouts.guest')

@section('title')
MCS - home
@endsection

@section('content')
<h1 class="error_title">不正なURL、<br>またはシステムエラーが発生しています。</h1>
<a href="{{ route('show_top') }}" class="back">トップページに戻る</a>
@endsection



