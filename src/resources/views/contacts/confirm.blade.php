<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h2>入力内容の確認</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
    </tr>
    <tr>
        <th>性別</th>
        <td>@if ($inputs['gender'] == 1)
                男性
            @elseif ($inputs['gender'] == 2)
                女性
            @else
                その他
            @endif</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
    </tr>
    <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
    </tr>
    <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] }}</td>
    </tr>
    <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $inputs['category_id'] }}</td>
    </tr>
    <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $inputs['detail'] }}</td>
    </tr>
</table>

{{-- 送信用フォーム --}}
<form action="/thanks" method="POST">
    @csrf

    @foreach($inputs as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <button type="submit">送信する</button>
</form>

{{-- 修正ボタン：入力画面に戻る --}}
<form action="/" method="GET">
    <button type="submit">修正する</button>
</form>

</body>
</html>