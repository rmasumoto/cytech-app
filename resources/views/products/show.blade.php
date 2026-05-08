@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">商品詳細</h1>

    <div class="product-detail">
        <p class="product-detail__item">商品名：{{ $dataProduct->product_name }}</p>
        <p class="product-detail__item">説明：{{ $dataProduct->description }}</p>

        <div class="product-detail__image-row">
            <span class="product-detail__image-label">画像：</span>
            @if ($dataProduct->img_path)
                <img class="product-detail__image"
                    src="{{ Storage::url($dataProduct->img_path) }}"
                    alt="{{ $dataProduct->product_name }}">
            @else
                <div class="product-detail__image-placeholder"></div>
            @endif
        </div>

        <p class="product-detail__item">金額：¥{{ number_format($dataProduct->price) }}</p>
        <p class="product-detail__item">会社：{{ $dataProduct->company->company_name ?? '—' }}</p>

        @auth
            <form action="{{ route('products.like', $dataProduct->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn--like {{ $isLiked ? 'btn--like--active' : '' }}">
                    {{ $isLiked ? '♥' : '♡' }}
                </button>
            </form>
        @endauth

        <div class="product-detail__actions">
            @auth
                <a href="{{ route('products.purchase', $dataProduct->id) }}"
                    class="btn btn--primary btn--wide">カートに追加する</a>
            @endauth
            <a href="{{ route('products.index') }}" class="btn btn--secondary">戻る</a>
        </div>
    </div>
</div>
@endsection
