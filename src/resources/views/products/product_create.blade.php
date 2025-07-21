@extends('layouts.app')

@section('content')
<div class="container">
  <h2>商品の出品</h2>

  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- 商品画像 --}}
    <div>
      <label for="img_url">商品画像</label>
      <input type="file" name="img_url" id="img_url">
    </div>

    {{-- カテゴリー（複数選択） --}}
    <div>
      <p>カテゴリ</p>
      @foreach ($categories as $category)
        <label>
          <input type="checkbox" name="categories[]" value="{{ $category->id }}">
          {{ $category->category }}
        </label>
      @endforeach
    </div>

    {{-- 商品の状態 --}}
    <div>
      <label for="condition_id">商品の状態</label>
      <select name="condition_id" id="condition_id" required>
        <option value="">選択してください</option>
        @foreach ($conditions as $condition)
          <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
        @endforeach
      </select>
    </div>

    {{-- 商品名 --}}
    <div>
      <label for="name">商品名</label>
      <input type="text" name="name" id="name" required>
    </div>

    {{-- ブランド名 --}}
    <div>
      <label for="brand_name">ブランド名</label>
      <input type="text" name="brand_name" id="brand_name">
    </div>

    {{-- 商品説明 --}}
    <div>
      <label for="description">商品の説明</label>
      <textarea name="description" id="description" rows="5" required></textarea>
    </div>

    {{-- 販売価格 --}}
    <div>
      <label for="price">販売価格</label>
      <input type="number" name="price" id="price" required>
    </div>

    <button type="submit">出品する</button>
  </form>
</div>
@endsection
