@extends('layouts.user')

@section('title')
MCS - {{ $current_theme->name }}
@endsection

@section('content')
<form class="favorite_btn" action="{{ route('favorite_theme', $current_theme->id) }}" method="POST">
    {{ csrf_field() }}
    <a href="{{ route('show_theme', $current_theme->id) }}"><h2>{{ $current_theme->name }}</h2></a>
    <input type="hidden" name="favorite" value="<?= $current_theme->favorite == '1' ? '0' : '1'; ?>">
    <button class="<?= $current_theme->favorite == '1' ? 'liked' : ''; ?>">
        <?= $current_theme->favorite == '1' ? 'お気に入りを解除' : 'お気に入りに登録'; ?>
    </button>
</form>


<form class="search" action="{{ route('search_record', $current_theme->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="text" placeholder="キーワード検索" name="keywords">
    <button>検索</button>
    @error('keywords')
    <span class="error">{{ $message }}</span>
    @enderror
</form>

<form class="add_table" action="{{ route('add_record', $current_theme->id) }}" method="POST">
    {{ csrf_field() }}
    <table>
        <thead>
            <tr>
                <th>コメント</th>
                <th>url</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="explanation">
                    @error('explanation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </td>
                <td><input type="text" name="url"></td>
            </tr>
        </tbody>
    </table>
    <button class="add_btn">追加</button>
</form>

<div class="cheat_sheet_table">
    <table>
    <thead>
        <tr>
            <th class="explanation">コメント</th>
            <th class="url">url</th>
            <th class="update">編集</th>
            <th class="delete">削除</th>
        </tr>
    </thead>
    @foreach ($records as $record)
    <tbody>
        <tr>
            <td class="explanation">{{ $record['explanation'] }}</td>
            <td class="url"><a target="_blank" href="{{ $record['url'] }}">{{ $record['url'] }}</a></td>
            <td class="update"><a href="{{ route('show_update', [$current_theme->id ,$record['id']]) }}">編集</a></td>
            <td class="delete"><a href="{{ route('delete_record', [$current_theme->id ,$record['id']]) }}">削除</a></td>
        </tr>
    </tbody>
    @endforeach
    </table>
</div>

@endsection
