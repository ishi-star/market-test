<!-- トップページ -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')

<div class="product-list">
  <div class="product-list__tab">
    <a href="/" class="product-list__tab-link {{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
    <a href="/?tab=mylist" class="product-list__tab-link {{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
  </div>

<div class="product-list__grid">
  {{-- マイリストタブ --}}
  @if (request('tab') === 'mylist')
      @auth
          @foreach ($products as $product)
            <div class="product-list__item">
              <a href="{{ route('products.show', ['id' => $product->id]) }}" class="product-list__decoration">
                <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}" class="product-list__image">
                
                {{--  SOLD 表示 --}}
                @if ($product->isSold())
                  <span class="product-list__sold-badge">SOLD</span>
                @endif
                <p class="product-list__name">{{ $product->name }}</p>
              </a>
            </div>
          @endforeach
      @endauth
      {{-- 未ログインなら何も出さない --}}
  @else
      {{-- おすすめタブ --}}
      @foreach ($products as $product)
        <div class="product-list__item">
          <a href="{{ route('products.show', ['id' => $product->id]) }}" class="product-list__decoration">
            <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}" class="product-list__image">
            
            {{-- ✅ SOLD 表示 --}}
            @if ($product->isSold())
              <span class="product-list__sold-badge">SOLD</span>
            @endif
            <p class="product-list__name">{{ $product->name }}</p>
          </a>
        </div>
      @endforeach
  @endif
</div>