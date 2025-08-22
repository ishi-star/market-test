
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile_create.css')}}">
@endsection

@section('link')

@endsection

@section('content')

<div class="profile-form">

  <h2 class="profile-form__heading content__heading">プロフィール登録</h2>
  <div class="profile-form__inner">
    <form class="profile-form__form" action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="profile-form__group">
        <label class="profile-form__label">プロフィール画像</label>
          @if(isset($user->profile->img_url))
          <img src="{{ Storage::url($user->profile->img_url) }}" alt="プロフィール画像" class="profile-form__preview" style="max-width:150px; display:block; margin-bottom:10px;">
          @endif
        <input class="profile-form__input" type="file" name="img_url">
        @error('img_url')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="username">ユーザー名</label>
        <input class="profile-form__input" type="text" name="name" id="name" placeholder="例：山田太郎"
        value="{{ old('name', $user->profile->name ?? '') }}">
        @error('name')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label">郵便番号</label>
        <input class="profile-form__input" type="text" name="zip" placeholder="例：123-4567"
        value="{{ old('zip', $user->profile->zip ?? '') }}">
        @error('zip')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="address">住所</label>
        <input class="profile-form__input" type="text" name="address" id="address" placeholder="例：名古屋市中区"
        value="{{ old('address', $user->profile->address ?? '') }}">
        @error('address')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="profile-form__group">
        <label class="profile-form__label" for="building">建物名</label>
        <input class="profile-form__input" type="text" name="building" id="building" placeholder="例：COACHTECHビル3F"
        value="{{ old('building', $user->profile->building ?? '')}}">
        @error('building')
        <p class="profile-form__error-message">{{ $message }}</p>
        @enderror
      </div>

      <input class="profile-form__btn btn" type="submit" value="更新する">
    </form>
  </div>
</div>
@endsection