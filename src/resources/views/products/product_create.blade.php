@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products/product_create.css') }}">
@endsection

@section('content')

<div class="container">
  <h2>商品の出品</h2>

  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
    @csrf

    {{-- 商品画像 --}}
    <div class="product-border">
      <label for="img_url" class="custom-file-label">画像を選択する</label>
      <input class="product-img" type="file" name="img_url" id="img_url" accept="image/*">
      <img class="img_preview" id="img_preview" src="" >
      @error('img_url')
        <div class="error-message">{{ $message }}</div>
      @enderror
    </div>

    <script>
      const input = document.getElementById('img_url');
      const preview = document.getElementById('img_preview');

      input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          }
          reader.readAsDataURL(file);
        } else {
          preview.src = '';
          preview.style.display = 'none';
        }
      });
    </script>

    {{-- カテゴリー（複数選択） --}}
    {{-- カテゴリー --}}
    <div class="form-group">
      <h3 class="product-detail">商品の詳細</h3>
      <h4>カテゴリー</h4>
      <div class="checkbox-group">
        @foreach ($categories as $category)
          <label>
            <input class="category" type="checkbox" name="categories[]" value="{{ $category->id }}"
                  @if(in_array($category->id, old('categories', []))) checked @endif>
              @if(in_array($category->id, old('categories', []))) checked @endif>
            <span>{{ $category->category }}</span>
          </label>
        @endforeach
      </div>
      @error('categories')
        <div class="error-message">{{ $message }}</div>
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 商品の状態 --}}
    <div class="form-group">
      <label for="condition_id">商品の状態</label>
      <select name="condition_id" id="condition_id">
        <option value="">選択してください</option>
        @foreach ($conditions as $condition)
          <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
          <option value="{{ $condition->id }}" @if(old('condition_id') == $condition->id) selected @endif>
            {{ $condition->condition }}
          </option>
        @endforeach
      </select>
      @error('condition_id')
        <div class="error-message">{{ $message }}</div>
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 商品名 --}}
    <div class="form-group">
      <label for="name">商品名</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}">
      @error('name')
        <div class="error-message">{{ $message }}</div>
    <h3 class="product-detail">商品名と説明</h3>
    <div>
      <label for="name">商品名</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}">
      @error('name')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- ブランド名 --}}
    <div class="form-group">
      <label for="brand_name">ブランド名</label>
      <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">
      @error('brand_name')
        <div class="error-message">{{ $message }}</div>
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 商品説明 --}}
    <div class="form-group">
      <label for="description">商品の説明</label>
      <textarea name="description" id="description" rows="5">{{ old('description') }}</textarea>
      @error('description')
        <div class="error-message">{{ $message }}</div>
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 販売価格 --}}
    <div class="form-group">
      <label for="price">販売価格</label>
      <input type="number" name="price" id="price" value="{{ old('price') }}">
      @error('price')
        <div class="error-message">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="submit-btn">出品する</button>
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <button class="product-sale" type="submit">出品する</button>
  </form>
</div>
@endsection

