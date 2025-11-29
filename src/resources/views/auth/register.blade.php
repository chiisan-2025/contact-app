<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>ユーザー登録</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 16px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label>名前</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password">
        </div>
        <div>
            <label>パスワード（確認）</label>
            <input type="password" name="password_confirmation">
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>