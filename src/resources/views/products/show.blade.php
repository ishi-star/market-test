@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products/show.css') }}">
@endsection

@section('link')
<form id="logout-form" action="/logout" method="POST" >
  @csrf
  <button type="submit" class="header__link" >
    ログアウト
  </button>
</form>
<a class="header__link" href="/mypage">マイページ</a>
<a class="header__link" href="/sell">出品</a>
@endsection

@section('content')
<div class="product-detail">
  <div class="product-detail__container">
    <!-- 商品画像 -->
    <div class="product-detail__image">
      <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像">
    </div>

    <!-- 商品情報 -->
    <div class="product-detail__info">
      <h2 class="product-detail__name">{{ $product->name }}</h2>
      <p class="product-detail__brand">{{ $product->brand_name }}</p>
      <p class="product-detail__price">¥{{ number_format($product->price) }} <span>（税込）</span></p>

      <div class="product-detail__actions">
        <p>⭐ {{ $product->likes_count }}　💬 {{ $product->comments_count }}</p>
        <a href="/purchase/{{ $product->id }}" class="btn btn--red">購入手続きへ</a>
      </div>

      <!-- 商品説明 -->
      <div class="product-detail__section">
        <h3>商品説明</h3>
        <p>カラー：{{ $product->color }}</p>
        <p>{{ $product->description }}</p>
      </div>

      <!-- 商品の情報 -->
      <div class="product-detail__section">
        <h3>商品の情報</h3>
        <p>カテゴリ：
          @foreach ($product->categories as $category)
            <span class="product-detail__tag">{{ $category->name }}</span>
          @endforeach
        </p>
        <p>商品の状態：{{ $product->condition }}</p>
      </div>

      <!-- コメント一覧 -->
      <div class="product-detail__section">
        <h3>コメント ({{ $product->comments->count() }})</h3>
        @foreach ($product->comments as $comment)
        <div class="comment">
          <div class="comment__user">
            <img src="{{ asset('storage/' . ($comment->user->icon ?? 'default-icon.png')) }}" alt="icon" class="comment__icon">
            <span class="comment__name">{{ $comment->user->name }}</span>
          </div>
          <p class="comment__body">{{ $comment->body }}</p>
        </div>
        @endforeach
      </div>

      <!-- コメントフォーム -->
      <form action="/item/{{ $product->id }}/comment" method="POST" class="comment-form">
        @csrf
        <textarea name="body" rows="4" placeholder="商品のコメント" required></textarea>
        <button type="submit" class="btn btn--red">コメントを送信する</button>
      </form>
    </div>
  </div>
</div>
@endsection
