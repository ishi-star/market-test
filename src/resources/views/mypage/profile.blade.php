@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
@endsection

@section('content')
<div class="mypage">
  <h2 class="mypage__title">プロフィール画面</h2>

  <div class="mypage__profile">
    <div class="mypage__avatar"></div>
    <div class="mypage__username">{{ $user->name }}</div>
    <a href="{{ route('user.profile.edit') }}" class="mypage__edit-btn">プロフィールを編集</a>
  </div>
{{--
  <div class="mypage__tabs">
    <a href="{{ route('user.products.selling') }}" class="mypage__tab">出品した商品</a>
    <a href="{{ route('user.products.purchased') }}" class="mypage__tab">購入した商品</a>
  </div>
  --}}

  <div class="mypage__products">
    @foreach ($products as $product)
    <div class="mypage__product-card">
      <img src="{{ asset('storage/' . $product->img_url) }}" alt="商品画像" class="mypage__product-image">
      <p class="mypage__product-name">{{ $product->name }}</p>
    </div>
    @endforeach
  </div>
</div>
@endsection