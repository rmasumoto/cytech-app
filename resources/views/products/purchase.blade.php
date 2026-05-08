@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">購入画面</h1>

    <div class="product-detail">
        <p class="product-detail__item">商品名：{{ $dataProduct->product_name }}</p>
        <p class="product-detail__item">説明：{{ $dataProduct->description }}</p>

        @if ($dataProduct->img_path)
            <div class="product-detail__image-wrap">
                <p class="product-detail__label">画像：</p>
                <img class="product-detail__image" src="{{ Storage::url($dataProduct->img_path) }}"
                    alt="{{ $dataProduct->product_name }}">
            </div>
        @endif

        <p class="product-detail__item">金額：¥{{ number_format($dataProduct->price) }}</p>
        <p class="product-detail__item">会社：{{ $dataProduct->company->company_name ?? '—' }}</p>
        <p class="product-detail__item">在庫数：{{ $dataProduct->stock }}</p>
    </div>

    <form action="{{ route('purchase.store', $dataProduct->id) }}" method="POST" class="form-inline">
        @csrf
        <div class="form-group form-group--inline">
            <label class="form-group__label" for="quantity">個数</label>
            <input class="form-group__input form-group__input--sm" type="number" id="quantity"
                name="quantity" min="1" max="{{ $dataProduct->stock }}"
                value="{{ old('quantity', 1) }}" required>
        </div>
        <div class="product-detail__actions">
            <button type="submit" class="btn btn--primary">購入する</button>
            <a href="{{ route('products.show', $dataProduct->id) }}" class="btn btn--secondary">戻る</a>
        </div>
    </form>
</div>
@endsection
