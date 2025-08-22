@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('content')
<div class="mypage">

  <div class="mypage__profile">
    <div class="mypage__avatar">
      @if ($user->profile && $user->profile->img_url)
        <img src="{{ Storage::url($user->profile->img_url) }}" alt="プロフィール画像" class="mypage__avatar-img">
      @else
        <img src="{{ asset('images/default-profile.png') }}" alt="デフォルト画像" class="mypage__avatar-img">
      @endif
    </div>
    <div class="mypage__username">{{ $user->name }}</div>
    <a href="{{ route('user.profile.edit') }}" class="mypage__edit-btn">プロフィールを編集</a>
  </div>
  {{-- タブ --}}
  <div class="mypage__tabs">
    <a href="{{ route('mypage', ['tab' => 'selling']) }}" 
       class="mypage__tab {{ $tab === 'selling' ? 'active' : '' }}">
      出品した商品
    </a>
    <a href="{{ route('mypage', ['tab' => 'purchased']) }}" 
       class="mypage__tab {{ $tab === 'purchased' ? 'active' : '' }}">
      購入した商品
    </a>
  </div>

  {{-- 出品した商品 --}}

<div class="product-list__grid">
  @if ($tab === 'selling')
    @forelse ($sellingProducts as $product)
      <div class="product-list__item">
        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="product-list__decoration">
          <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}" class="product-list__image">

          {{-- SOLD表示 --}}
          @if ($product->isSold())
            <span class="product-list__sold-badge">SOLD</span>
          @endif

          <p class="product-list__name">{{ $product->name }}</p>
        </a>
      </div>
    @empty
      <p>出品した商品はありません。</p>
    @endforelse
  @else
    @forelse ($purchasedProducts as $sold)
      <div class="product-list__item">
        <a href="{{ route('products.show', ['product' => $sold->product->id]) }}" class="product-list__decoration">
          <img src="{{ asset('storage/' . $sold->product->img_url) }}" alt="{{ $sold->product->name }}" class="product-list__image">

          @if ($sold->product->isSold())
            <span class="product-list__sold-badge">SOLD</span>
          @endif

          <p class="product-list__name">{{ $sold->product->name }}</p>
        </a>
      </div>
    @empty
      <p>購入した商品はありません。</p>
    @endforelse
  @endif
</div>

@endsection