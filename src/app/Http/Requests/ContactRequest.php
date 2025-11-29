<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //お名前（姓・名） ※建物名以外は全部必須
            'last_name'  => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],

            // 性別（1:男性 2:女性 3:その他）
            'gender' => ['required', 'in:1,2,3'],

            // メールアドレス（必須・形式チェック）
            'email' => ['required', 'email', 'max:255'],

            // 電話番号
            'tel1' => ['required', 'numeric', 'digits_between:2,5'],
            'tel2' => ['required', 'numeric', 'digits_between:2,5'],
            'tel3' => ['required', 'numeric', 'digits_between:2,5'],

            // 住所
            'address' => ['required', 'string', 'max:255'],

            // 建物名（必須ではない）
            'building' => ['nullable', 'string', 'max:255'],

            // お問い合わせの種類（categories.id）
            'category_id' => ['required', 'exists:categories,id'],

            // お問い合わせ内容
            'detail' => ['required', 'string', 'max:120'],
        ];
    }
    public function messages()
{
    return [
        // 1. お名前
        'last_name.required' => '姓を入力してください',
        'first_name.required' => '名を入力してください',

        // 2. 性別
        'gender.required' => '性別を選択してください',

        // 3. メールアドレス
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',

        // 4. 電話番号
        'tel1.required' => '電話番号を入力してください',
        'tel1.numeric'  => '電話番号は半角数字で入力してください',
        'tel1.digits_between' => '電話番号は5桁まで数字で入力してください',

        'tel2.required' => '電話番号を入力してください',
        'tel2.numeric'  => '電話番号は半角数字で入力してください',
        'tel2.digits_between' => '電話番号は5桁まで数字で入力してください',

        'tel3.required' => '電話番号を入力してください',
        'tel3.numeric'  => '電話番号は半角数字で入力してください',
        'tel3.digits_between' => '電話番号は5桁まで数字で入力してください',

        // 5. 住所
        'address.required' => '住所を入力してください',

        // 6. 建物名（任意） → エラー出さないので不要

        // 7. お問い合わせの種類
        'category_id.required' => 'お問い合わせの種類を選択してください',

        // 8. お問い合わせ内容
        'detail.required' => 'お問い合わせ内容を入力してください',
        'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
    ];
}
}
