@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-card">
        <h2 class="form-card__title">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-group__label" for="name">Name（ユーザ名）</label>
                <input class="form-group__input" type="text" id="name" name="name"
                    value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label class="form-group__label" for="nameKanji">名前（漢字）</label>
                <input class="form-group__input" type="text" id="nameKanji" name="name_kanji"
                    value="{{ old('name_kanji') }}">
            </div>
            <div class="form-group">
                <label class="form-group__label" for="nameKana">名前（カナ）</label>
                <input class="form-group__input" type="text" id="nameKana" name="name_kana"
                    value="{{ old('name_kana') }}">
            </div>
            <div class="form-group">
                <label class="form-group__label" for="email">Email Address</label>
                <input class="form-group__input" type="email" id="email" name="email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label class="form-group__label" for="password">Password</label>
                <input class="form-group__input" type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label class="form-group__label" for="passwordConfirmation">Confirm Password</label>
                <input class="form-group__input" type="password" id="passwordConfirmation"
                    name="password_confirmation" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
