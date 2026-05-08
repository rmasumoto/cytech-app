@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">アカウント情報編集</h1>

    <form action="{{ route('account.update') }}" method="POST" class="form-block">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-group__label" for="name">ユーザ名</label>
            <input class="form-group__input" type="text" id="name" name="name"
                value="{{ old('name', $dataUser->name) }}" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="email">Eメール</label>
            <input class="form-group__input" type="email" id="email" name="email"
                value="{{ old('email', $dataUser->email) }}" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="nameKanji">名前</label>
            <input class="form-group__input" type="text" id="nameKanji" name="name_kanji"
                value="{{ old('name_kanji', $dataUser->name_kanji) }}">
        </div>
        <div class="form-group">
            <label class="form-group__label" for="nameKana">カナ</label>
            <input class="form-group__input" type="text" id="nameKana" name="name_kana"
                value="{{ old('name_kana', $dataUser->name_kana) }}">
        </div>
        <div class="form-actions">
            <a href="{{ route('mypage.index') }}" class="btn btn--secondary">戻る</a>
            <button type="submit" class="btn btn--primary">更新</button>
        </div>
    </form>
</div>
@endsection
