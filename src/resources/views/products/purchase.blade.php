@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
  {{-- ✅ 完了メッセージ --}}
  @if (session('success'))
    <div class="alert-success">
      {{ session('success') }}
    </div>
  @endif


  <!-- <h2 class="purchase__heading content__heading">商品購入</h2> -->
  <div class="purchase__container">
    {{-- 左側：商品情報とフォーム --}}
    <div class="purchase__left">
      <div class="purchase__product-box">
        <div class="purchase__product-image">
          <img src="{{ asset('storage/' . $product->img_url) }}" alt="商品画像">
        </div>
        <div class="purchase__product-info">
          <p class="purchase__product-name">{{ $product->name }}</p>
          <p class="purchase__product-price">¥{{ number_format($product->price) }}</p>
        </div>
      </div>

      <form class="purchase__form" action="{{ route('purchase.submit', $product->id) }}" method="POST">
        @csrf
        <div class="purchase__form-group">
          <label class="purchase__label" for="payment_method">支払い方法</label>
          <select class="purchase__select" name="payment_method" id="payment_method" required>
            <option value="">選択してください</option>
            <option value="credit"
              {{ old('payment_method', $selectedPaymentMethod) === 'credit' ? 'selected' : '' }}>
              カード
            </option>
            <option value="konbini"
              {{ old('payment_method', $selectedPaymentMethod) === 'konbini' ? 'selected' : '' }}>
              コンビニ払い
            </option>
          </select>

          @error('payment_method')
            <p class="purchase__error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="purchase__form-group">
          <p class="purchase__label">配送先</p>
          <p class="purchase__address">
            〒{{ $profile->zip }}<br>
            {{ $profile->address }}
            {{ $profile->building ?? '' }}<br>
            <a href="{{ route('address.edit', ['item_id' => $product->id]) }}" class="purchase__address-link">変更する</a>
          </p>
        </div>


    </div>

    {{-- 右側：明細 --}}
    <div class="purchase__right">
      <div class="purchase__summary-box">
        <p class="purchase__summary-item">商品代金：¥{{ number_format($product->price) }}</p>
        <p class="purchase__summary-item">
          支払い方法：
          <span id="selected-payment-method">
            @if ($selectedPaymentMethod === 'credit')
              カード
            @elseif ($selectedPaymentMethod === 'konbini')
              コンビニ払い
            @else
              未選択
            @endif
          </span>
        </p>
      </div>
              <input type="submit" class="purchase__submit-btn btn" value="購入する">
      </form>
    </div>
  </div>
</div>
@endsection



