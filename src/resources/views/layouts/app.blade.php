<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  @yield('css')
</head>

<body>
  <div class="app">
    <header class="header">
     <img src="{{ asset('storage/images/logo.svg') }}" alt="coachtech" width="240" height="80">
      @yield('link')
    </header>
    <div class="content">
      @yield('content')
    </div>
  </div>
</body>

</html>