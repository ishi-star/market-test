
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
@endsection

@section('link')

@endsection

@section('content')

<div class="profile-form">
  <h2 class="profile-form__heading content__heading">プロフィール登録</h2>
  <div class="profile-form__inner">
    <form class="profile-form__form" action="/profile" method="post" enctype="multipart/form-data">
      @csrf

      <div class="profile-form__group">
        <label class="profile-form__label" for="avatar">プロフィール画像</label>
        <input class="profile-form__input" type="file" name="avatar" id="avatar">
        @error('avatar')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="username">ユーザー名</label>
        <input class="profile-form__input" type="text" name="username" id="username" placeholder="例：mio_tech">
        @error('username')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="postcode">郵便番号</label>
        <input class="profile-form__input" type="text" name="postcode" id="postcode" placeholder="例：460-0008">
        @error('postcode')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="address">住所</label>
        <input class="profile-form__input" type="text" name="address" id="address" placeholder="例：名古屋市中区栄1丁目">
        @error('address')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="building">建物名</label>
        <input class="profile-form__input" type="text" name="building" id="building" placeholder="例：COACHTECHビル3F">
        @error('building')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <input class="profile-form__btn btn" type="submit" value="更新する">
    </form>
  </div>
</div>
@endsection