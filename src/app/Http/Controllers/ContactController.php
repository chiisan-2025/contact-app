<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // 入力フォーム
    public function index()
    {
        // カテゴリー一覧を取得（セレクトボックス用）
        $categories = Category::all();

        return view('contacts.index', compact('categories'));
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
        // 入力値をすべて取得
        $inputs = $request->validated();

        return view('contacts.confirm', compact('inputs'));
    }

    // 完了画面
    public function store(ContactRequest $request)
    {
        $inputs = $request->validated();
        $tel = $inputs['tel1'] . $inputs['tel2'] . $inputs['tel3'];

        Contact::create([
            'last_name'   => $inputs['last_name'],
            'first_name'  => $inputs['first_name'],
            'gender'      => $inputs['gender'],
            'email'       => $inputs['email'],
            'tel'         => $tel,
            'address'     => $inputs['address'],
            'building'    => $inputs['building'] ?? null,
            'category_id' => $inputs['category_id'],
            'detail'      => $inputs['detail'],
        ]);

        // 二重送信防止
        $request->session()->regenerateToken();
        return view('contacts.thanks');
    }

}
