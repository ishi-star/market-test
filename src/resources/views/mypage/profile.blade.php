@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
@endsection

@section('content')
<div class="mypage">

  <div class="mypage__profile">
    <div class="mypage__avatar"></div>
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

<div class="mypage__products">
  @if ($tab === 'selling')
    @forelse ($sellingProducts as $product)
      <div class="mypage__product-card">
        <img src="{{ asset('storage/' . $product->img_url) }}" alt="商品画像">
        <p>{{ $product->name }}</p>
      </div>
    @empty
      <p>出品した商品はありません。</p>
    @endforelse
  @else
    @forelse ($purchasedProducts as $sold)
      <div class="mypage__product-card">
        <img src="{{ asset('storage/' . $sold->product->img_url) }}" alt="商品画像">
        <p>{{ $sold->product->name }}</p>
      </div>
    @empty
      <p>購入した商品はありません。</p>
    @endforelse
  @endif
</div>
@endsection