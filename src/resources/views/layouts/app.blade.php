<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>共通部分</title>
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  @yield('css')
</head>

<body>
  <div class="app">
    <header class="header">
    <img src="{{ asset('storage/images/logo.svg') }}" alt="coachtech" width="240" height="80">

    @unless(in_array(Route::currentRouteName(), ['login', 'register']))
    <div class="search-bar">
      <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="keyword" placeholder="なにをお探しですか？" class="search-bar__input">
        <button type="submit" class="search-bar__button">検索</button>
      </form>
    </div>
    @endunless


    {{-- ログインページと登録ページではリンクを非表示 --}}
    @unless(in_array(Route::currentRouteName(), ['login', 'register']))
      @auth
      <form id="logout-form" action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="header__link">ログアウト</button>
      </form>
      <a class="header__link" href="/mypage">マイページ</a>
      <a class="header__link" href="/sell">出品</a>
      @endauth

      @guest
      <a class="header__link" href="/login">ログイン</a>
      <a class="header__link" href="/mypage">マイページ</a>
      <a class="header__link" href="/sell">出品</a>
      @endguest
    @endunless

    @yield('link')
    </header>
    <div class="content">
      @yield('content')
    </div>
  </div>
</body>

</html>