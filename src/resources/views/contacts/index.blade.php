@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="brand">FashionablyLate</div>
    <div class="title">Contact</div>

    {{-- 全体のエラー表示 --}}
    @if ($errors->any())
        <div class="error-summary">
            <p>入力内容に誤りがあります。</p>
        </div>
    @endif

    <form action="/confirm" method="POST">
        @csrf

        <table class="form-table">
            {{-- お名前 --}}
            <tr>
                <th>
                    お名前<span class="required">必須</span>
                </th>
                <td>
                    <div class="name-inputs">
                        <div class="name-field">
                            <input type="text" name="last_name" placeholder="姓"
                                value="{{ old('last_name') }}">
                            @error('last_name')
                            <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="name-field">
                        <input type="text" name="first_name" placeholder="名"
                                value="{{ old('first_name') }}">
                        @error('first_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </td>
            </tr>

            {{-- 性別 --}}
            <tr>
                <th>
                    性別<span class="required">必須</span>
                </th>
                <td>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="gender" value="1"
                                    {{ old('gender') == '1' ? 'checked' : '' }}>
                            男性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="2"
                                    {{ old('gender') == '2' ? 'checked' : '' }}>
                            女性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="3"
                                    {{ old('gender') == '3' ? 'checked' : '' }}>
                            その他
                        </label>
                    </div>
                    @error('gender')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- メールアドレス --}}
            <tr>
                <th>
                    メールアドレス<span class="required">必須</span>
                </th>
                <td>
                    <input type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- 電話番号 --}}
            <tr>
                <th>
                    電話番号<span class="required">必須</span>
                </th>
                <td>
                    <div class="tel-inputs">
                        <input type="text" name="tel1" value="{{ old('tel1') }}">
                        <span class="tel-separator">-</span>
                        <input type="text" name="tel2" value="{{ old('tel2') }}">
                        <span class="tel-separator">-</span>
                        <input type="text" name="tel3" value="{{ old('tel3') }}">
                    </div>

                    @php
                        $telError =
                            $errors->first('tel1') ?:
                            $errors->first('tel2') ?:
                            $errors->first('tel3');
                    @endphp

                    @if ($telError)
                        <div class="field-error">{{ $telError }}</div>
                    @endif
                </td>
            </tr>

            {{-- 住所 --}}
            <tr>
                <th>
                    住所<span class="required">必須</span>
                </th>
                <td>
                    <input type="text" name="address" value="{{ old('address') }}">
                    @error('address')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- 建物名 --}}
            <tr>
                <th>建物名</th>
                <td>
                    <input type="text" name="building" value="{{ old('building') }}">
                    @error('building')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- お問い合わせの種類 --}}
            <tr>
                <th>
                    お問い合わせの種類<span class="required">必須</span>
                </th>
                <td>
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @isset($categories)
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                    @error('category_id')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- お問い合わせ内容 --}}
            <tr>
                <th>
                    お問い合わせ内容<span class="required">必須</span>
                </th>
                <td>
                    <textarea name="detail">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <div class="actions">
            <button type="submit" class="btn-confirm">確認画面へ</button>
        </div>
    </form>
</div>
@endsection