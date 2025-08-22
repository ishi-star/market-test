@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products/show.css') }}">
@endsection

@section('content')
<div class="product-detail">
  <div class="product-detail__container">
    
    <!-- 左カラム：商品画像 -->
    <div class="product-detail__image">
      <img src="{{ asset('storage/' . $product->img_url) }}" alt="商品画像">
    </div>

    <!-- 右カラム：商品情報 -->
    <div class="product-detail__info">

      <!-- 商品名・ブランド・価格 -->
      <div class="product-detail__summary">
        <h2 class="product-name">{{ $product->name }}</h2>
        <p class="product-brand__name">
          ブランド名: {{ $product->brand_name }}
        </p>
        <p class="price">¥{{ number_format($product->price) }} <span>（税込）</span>
        </p>
      </div>

      <!-- いいね・コメント・購入ボタン -->

      <div class="product-detail__actions">
        @auth
          @if ($userLiked)
            <form action="{{ route('products.unlike', $product->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="action-icon">
                <span class="icon icon--yellow">★</span>
                <span class="count"> {{ $product->likes_count }}</span>
              </button>
            </form>
          @else
            <form action="{{ route('products.like', $product->id) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="action-icon">
                <span class="icon icon--gray">★</span>
                <span class="count"> {{ $product->likes_count }}</span>
              </button>
            </form>
          @endif
        @else
          <div class="action-icon">
            <span class="icon icon--gray">☆</span>
            <span class="count"> {{ $product->likes_count }}</span>
          </div>
        @endauth

        <div class="action-icon">
          <span class="icon">💬</span>
          <span class="count">{{ $product->comments_count }}</span>
        </div>
      </div>



      <a href="/purchase/{{ $product->id }}" class="btn btn--red btn--purchase">購入手続きへ</a>

      <!-- 商品説明 -->
      <div class="product-detail__section">
        <h3 class="product-header">商品説明</h3>
        <p>{{ $product->description }}</p>
      </div>

      <!-- 商品情報 -->
      <div class="product-detail__section">
        <h3 class="product-header">商品の情報</h3>
        <p>カテゴリ：
          @foreach ($product->categories as $category)
            <span class="product-detail__tag">{{ $category->category }}</span>
          @endforeach
        </p>
        <p>商品の状態：{{ $product->condition->condition }}</p>
      </div>

      <!-- コメント一覧 -->
      <div class="product-detail__section">
        <p class="comment-data">コメント ({{ $product->comments->count() }})</p>
        @foreach ($product->comments as $comment)
          <div class="comment">
            <div class="comment__user">
              <img src="{{ $comment->user->profile && $comment->user->profile->img_url 
                            ? asset('storage/' . $comment->user->profile->img_url) 
                            : asset('storage/default-icon.png') }}" 
                  alt="icon" class="comment__icon">
              <span class="comment__name">{{ $comment->user->name }}</span>
            </div>
            <p class="comment__body">{{ $comment->comment }}</p>
          </div>
        @endforeach
      </div>

      <!-- コメントフォーム -->
      <form action="{{ route('comments.store', $product->id) }}" method="POST" class="comment-form">
        @csrf
        <p class="comment-product">商品へのコメント</p>
        <textarea name="comment" rows="4">{{ old('comment') }}</textarea>
        {{-- バリデーションエラー --}}
        @error('comment')
          <div class="error-message" style="color:red; font-size:14px;">
            {{ $message }}
          </div>
        @enderror
        <button type="submit" class="btn btn--red">コメントを送信する</button>
      </form>

    </div> <!-- /.product-detail__info -->

  </div> <!-- /.product-detail__container -->
</div> <!-- /.product-detail -->
@endsection
