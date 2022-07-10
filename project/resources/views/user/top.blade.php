@extends('layouts.user')

@section('title')
MCS - top
@endsection

@section('content')
<h2>カテゴリー</h2>
<form action="{{ route('create_theme') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="theme_name">
    <button>新規登録</button>
</form>
<div class="categories">
    <div class="category">
        <ul>
            @if (@$themes)
                @foreach ($themes as $theme)
                    <li><a href="{{ route('show_theme', $theme['id']) }}">{{ $theme['name'] }}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@endsection



