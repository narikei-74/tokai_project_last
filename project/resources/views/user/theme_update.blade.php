@extends('layouts.user')

@section('title')
MCS - {{ $current_theme->name }}
@endsection

@section('content')
<form class="favorite_btn" action="{{ route('favorite_theme', $current_theme->id) }}" method="POST">
    {{ csrf_field() }}
    <a href="{{ route('show_theme', $current_theme->id) }}"><h2>{{ $current_theme->name }}</h2></a>
    <input type="hidden" name="favorite" value="<?= $current_theme->favorite == '1' ? '0' : '1'; ?>">
    <button class="{{ <?= $current_theme->favorite == '1' ? 'liked' : ''; ?> }}">
        <?= $current_theme->favorite == '1' ? 'お気に入りを解除' : 'お気に入りに登録'; ?>
    </button>
</form>

<form class="add_table" action="{{ route('update_record', [$current_theme->id, $update_record->id]) }}" method="POST">
    {{ csrf_field() }}
    <table>
        <thead>
            <tr>
                <th class="explanation">コメント</th>
                <th class="url">url</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="explanation" value="{{ $update_record->explanation }}">
                    @error('explanation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </td>
                <td><input type="text" name="url" value="{{ $update_record->url }}"></td>
            </tr>
        </tbody>
    </table>
    <button class="add_btn">追加</button>
</form>
<a href="{{ route('show_theme', $current_theme->id) }}">戻る</a>


@endsection
