@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">お問い合わせフォーム</h1>

    <form action="{{ route('contact.send') }}" method="POST" class="form-block">
        @csrf
        <div class="form-group">
            <label class="form-group__label" for="name">名前</label>
            <input class="form-group__input" type="text" id="name" name="name"
                value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="email">メールアドレス</label>
            <input class="form-group__input" type="email" id="email" name="email"
                value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="message">お問い合わせ内容</label>
            <textarea class="form-group__textarea form-group__textarea--lg" id="message"
                name="message" required>{{ old('message') }}</textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">送信</button>
            <a href="{{ route('products.index') }}" class="btn btn--secondary">戻る</a>
        </div>
    </form>
</div>
@endsection
