@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">出品商品詳細</h1>

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
    </div>

    <div class="product-detail__actions">
        <a href="{{ route('mypage.products.edit', $dataProduct->id) }}" class="btn btn--primary">編集</a>

        <form action="{{ route('mypage.products.destroy', $dataProduct->id) }}" method="POST"
            onsubmit="return confirm('本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn--danger">削除する</button>
        </form>

        <a href="{{ route('mypage.index') }}" class="btn btn--secondary">戻る</a>
    </div>
</div>
@endsection
