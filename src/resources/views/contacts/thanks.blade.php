<!-- resources/views/contacts/thanks.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>送信完了</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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