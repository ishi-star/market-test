<!-- ログイン前のトップページ -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
<div class="product-list">
  <div class="product-list__tab">
    <a href="/" class="product-list__tab-link active">おすすめ</a>
    <a href="/?tab=mylist" class="product-list__tab-link">マイリスト</a>
  </div>

  <div class="product-list__grid">
    @foreach ($products as $product)
    <div class="product-list__item">
      <a href="{{ route('products.show', ['id' => $product->id]) }}">
        <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}" class="product-list__image">
        <p class="product-list__name">{{ $product->name }}</p>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection