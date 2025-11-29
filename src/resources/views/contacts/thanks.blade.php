<!-- resources/views/contacts/thanks.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>送信完了</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", sans-serif;
            background-color: #f5f3f0;
        }
        .wrapper {
            max-width: 900px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px 60px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            text-align: center;
        }
        .brand {
            font-size: 22px;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
            color: #4b3b31;
        }
        .title {
            font-size: 18px;
            margin-bottom: 24px;
            color: #4b3b31;
        }
        .message {
            margin-bottom: 32px;
        }
        .btn-home {
            min-width: 160px;
            padding: 8px 32px;
            border-radius: 4px;
            border: none;
            background: #6b4f3f;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-home:hover {
            opacity: .9;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="brand">FashionablyLate</div>
    <div class="title">Contact</div>

    <p class="message">
        お問い合わせありがとうございました。<br>
        担当者よりご連絡させていただきます。
    </p>

    <form action="/" method="GET">
        <button type="submit" class="btn-home">HOMEへ戻る</button>
    </form>
</div>
</body>
</html>