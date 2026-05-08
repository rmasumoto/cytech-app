@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-card">
        <h2 class="form-card__title">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-group__label" for="email">Email Address</label>
                <input class="form-group__input" type="email" id="email" name="email"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-group__label" for="password">Password</label>
                <input class="form-group__input" type="password" id="password" name="password" required>
            </div>
            <div class="form-group form-group--checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Login</button>
                <a href="{{ route('register') }}" class="form-actions__link">新規登録はこちら</a>
            </div>
        </form>
    </div>
</div>
@endsection
