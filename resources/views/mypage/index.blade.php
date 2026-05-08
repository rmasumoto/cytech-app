@extends('layouts.app')

@section('content')
<div class="page">
    <h1 class="page__title">マイページ</h1>

    <a href="{{ route('account.edit') }}" class="btn btn--primary">アカウント編集</a>

    <div class="mypage-user">
        <div class="mypage-user__col">
            <p class="mypage-user__item">ユーザ名：{{ $dataUser->name }}</p>
            <p class="mypage-user__item">Eメール：{{ $dataUser->email }}</p>
        </div>
        <div class="mypage-user__col">
            <p class="mypage-user__item">名前：{{ $dataUser->name_kanji }}</p>
            <p class="mypage-user__item">カナ：{{ $dataUser->name_kana }}</p>
        </div>
    </div>

    <section class="mypage-section">
        <div class="mypage-section__header">
            <h2 class="mypage-section__title">&lt;出品商品&gt;</h2>
            <a href="{{ route('mypage.products.create') }}" class="btn btn--success">新規登録</a>
        </div>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th class="table__th">商品番号</th>
                    <th class="table__th">商品名</th>
                    <th class="table__th">商品説明</th>
                    <th class="table__th">料金(¥)</th>
                    <th class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                @forelse ($dataListedProducts as $product)
                <tr class="table__row">
                    <td class="table__td">{{ $product->id }}</td>
                    <td class="table__td">{{ $product->product_name }}</td>
                    <td class="table__td">{{ $product->description }}</td>
                    <td class="table__td">{{ number_format($product->price) }}</td>
                    <td class="table__td">
                        <a href="{{ route('mypage.products.show', $product->id) }}" class="btn btn--success">詳細</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="table__td" colspan="5">出品している商品はありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <section class="mypage-section">
        <h2 class="mypage-section__title">&lt;購入した商品&gt;</h2>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th class="table__th">商品名</th>
                    <th class="table__th">商品説明</th>
                    <th class="table__th">料金(¥)</th>
                    <th class="table__th">個数</th>
                </tr>
            </thead>
            <tbody class="table__body">
                @forelse ($dataPurchasedProducts as $sale)
                <tr class="table__row">
                    <td class="table__td">{{ $sale->product->product_name }}</td>
                    <td class="table__td">{{ $sale->product->description }}</td>
                    <td class="table__td">{{ number_format($sale->product->price) }}</td>
                    <td class="table__td">{{ $sale->quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td class="table__td" colspan="4">購入した商品はありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
@endsection
