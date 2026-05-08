@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">出品商品編集</h1>

    <form action="{{ route('mypage.products.update', $dataProduct->id) }}" method="POST"
        enctype="multipart/form-data" class="form-block">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-group__label" for="productName">商品名</label>
            <input class="form-group__input" type="text" id="productName" name="product_name"
                value="{{ old('product_name', $dataProduct->product_name) }}" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="price">価格</label>
            <input class="form-group__input" type="number" id="price" name="price"
                value="{{ old('price', $dataProduct->price) }}" min="0" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="description">商品説明</label>
            <textarea class="form-group__textarea" id="description" name="description">{{ old('description', $dataProduct->description) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="stock">在庫数</label>
            <input class="form-group__input" type="number" id="stock" name="stock"
                value="{{ old('stock', $dataProduct->stock) }}" min="0" required>
        </div>
        <div class="form-group">
            <label class="form-group__label" for="imgPath">商品画像</label>
            @if ($dataProduct->img_path)
                <img class="form-group__preview" src="{{ Storage::url($dataProduct->img_path) }}"
                    alt="{{ $dataProduct->product_name }}">
            @endif
            <input class="form-group__file" type="file" id="imgPath" name="img_path" accept="image/*">
        </div>
        <div class="form-actions">
            <a href="{{ route('mypage.products.show', $dataProduct->id) }}" class="btn btn--secondary">戻る</a>
            <button type="submit" class="btn btn--primary">更新</button>
        </div>
    </form>
</div>
@endsection
