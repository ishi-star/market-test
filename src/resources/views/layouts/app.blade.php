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
  {{-- 左：ロゴ --}}
      <div class="header__left">
        <img src="{{ asset('storage/images/logo.svg') }}" alt="coachtech" width="200" height="50">
      </div>

  {{-- 中央：検索 --}}
  @unless(in_array(Route::currentRouteName(), ['login', 'register']))
    <div class="header__center">
      <form action="{{ route('products.index') }}" method="GET" class="search-bar">
        <input type="text" name="keyword" placeholder="なにをお探しですか？" class="search-bar__input" value="{{ request('keyword') }}" >
      </form>
    </div>
  @endunless

  {{-- 右：リンク --}}
  <div class="header__right">
    @unless(in_array(Route::currentRouteName(), ['login', 'register']))
      @auth
    <a href="{{ route('logout') }}" class="header__link"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
  @csrf
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
  </div>
</header>

    <div class="content">
      @yield('content')
    </div>
  </div>
</body>

</html>