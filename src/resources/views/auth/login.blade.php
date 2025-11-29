<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>ログイン</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password">
        </div>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>