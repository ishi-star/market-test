<!-- ログイン前のトップページ -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('link')
@if (Auth::check())
  <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="header__link">ログアウト</button>
  </form>
  <a class="header__link" href="/mypage">マイページ</a>
  <a class="header__link" href="{{ route('products.create') }}">出品</a>
@else
  <a class="header__link" href="/login">ログイン</a>
  <a class="header__link" href="/mypage">マイページ</a>
  <a class="header__link" href="{{ route('products.create') }}">出品</a>
@endif
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
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-list__image">
        <p class="product-list__name">{{ $product->name }}</p>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection