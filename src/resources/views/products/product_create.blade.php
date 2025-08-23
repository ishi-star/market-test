@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products/product_create.css') }}">
@endsection

@section('content')

<div class="container">
  <h2>商品の出品</h2>

  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- 商品画像 --}}
<div class="product-border">
  <label for="img_url" class="custom-file-label">画像を選択する</label>
  <input class="product-img" type="file" name="img_url" id="img_url" accept="image/*">
  <!-- ここにプレビュー用のimgタグを追加 -->
  <img id="img_preview" src="" alt="プレビュー画像" style="display:none; max-width:200px; margin-top:10px;">
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
<div class="form-group"> 
  <h3 class="product-detail">商品の詳細</h3>
  <h4>カテゴリー</h4> 
  <div class="checkbox-group"> @foreach ($categories as $category) 
    <label> 
      <input class="category" type="checkbox" name="categories[]" value="{{ $category->id }}" @if(in_array($category->id, old('categories', []))) checked @endif> 
      <span>{{ $category->category }}</span>
    </label> 
    @endforeach
  </div> 
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

    <h3 class="product-detail">商品名と説明</h3>
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

    <button class="product-sale" type="submit">出品する</button>
  </form>
</div>
@endsection
