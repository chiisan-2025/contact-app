<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ管理システム</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <form method="POST" action="{{ route('logout') }}" style="text-align: right; margin: 10px;">
        @csrf
        <button type="submit">ログアウト</button>
    </form>


    @yield('content')

</body>
</html>