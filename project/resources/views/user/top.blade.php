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
<ul class="theme_grid">
    @if (@$themes)
        @foreach ($themes as $theme)
            <li class="theme_recode">
                <a href="{{ route('show_theme', $theme['id']) }}">{{ $theme['name'] }}</a>
                <span class="material-symbols-outlined theme_delete_button">
                    delete
                </span>
                <div class="theme_delete" style="display: none;">
                    <form action="{{ route('delete_theme', $theme['id']) }}" method="post">
                        @csrf
                        <input type="hidden" name="theme_id" value="{{ $theme['id'] }}">
                        <p>本当に削除しますか？</p>
                        <button class="cancel_button" type="button">キャンセル</button>
                        <button>削除</button>
                    </form>
                </div>
            </li>
        @endforeach
    @endif
</ul>

<script>
    $('.theme_delete_button').on('click', function (e) {
        $(e.target).next().show();
    });
    $('.cancel_button').on('click', function () {
        $('.theme_delete').hide();
    });

</script>

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



