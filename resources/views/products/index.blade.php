@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">商品一覧</h1>

    <form action="{{ route('products.index') }}" method="GET" class="search-form">
        <input class="search-form__input" type="text" name="product_name"
            placeholder="商品名を入力" value="{{ request('product_name') }}">
        <input class="search-form__input search-form__input--price" type="number"
            name="min_price" placeholder="最低価格" value="{{ request('min_price') }}">
        <span class="search-form__separator">〜</span>
        <input class="search-form__input search-form__input--price" type="number"
            name="max_price" placeholder="最高価格" value="{{ request('max_price') }}">
        <button type="submit" class="btn btn--primary">検索</button>
    </form>

    <table class="table">
        <thead class="table__head">
            <tr>
                <th class="table__th">商品番号</th>
                <th class="table__th">商品名</th>
                <th class="table__th">商品説明</th>
                <th class="table__th">画像</th>
                <th class="table__th">料金(¥)</th>
                <th class="table__th"></th>
            </tr>
        </thead>
        <tbody class="table__body">
            @forelse ($dataProducts as $product)
            <tr class="table__row">
                <td class="table__td">{{ $product->id }}</td>
                <td class="table__td">{{ $product->product_name }}</td>
                <td class="table__td">{{ $product->description }}</td>
                <td class="table__td">
                    @if ($product->img_path)
                        <img class="table__img" src="{{ Storage::url($product->img_path) }}"
                            alt="{{ $product->product_name }}">
                    @endif
                </td>
                <td class="table__td">{{ number_format($product->price) }}</td>
                <td class="table__td">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn--success">詳細</a>
                </td>
            </tr>
            @empty
            <tr>
                <td class="table__td" colspan="6">商品がありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
