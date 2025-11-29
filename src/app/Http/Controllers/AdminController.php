<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 一覧表示（FN006）
    public function index(Request $request)
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(5);

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // 検索処理（FN021）
    public function search(Request $request)
    {
        // 入力値を session に保存（リセット時のため）
        session([
            'search.keyword'     => $request->keyword,
            'search.gender'      => $request->gender,
            'search.category_id' => $request->category_id,
            'search.from'        => $request->from,
            'search.to'          => $request->to,
        ]);

    // ベースのクエリ
        $query = Contact::query();

    // キーワード（名前 or メール）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

    // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

    // 種類（category_id）
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

    // 日付検索
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

    // 並び替え（新しい順）
        $contacts = $query->orderBy('created_at', 'desc')->paginate(5);

    // カテゴリも渡す
        $categories = Category::all();

            return view('admin.index', compact('contacts', 'categories'));
    }


    // 検索リセット（FN007）
        public function reset(Request $request)
        {
            // 検索条件に使っているセッションを全部削除
            $request->session()->forget([
                'search.keyword',
                'search.gender',
                'search.category_id',
                'search.from',
                'search.to',
            ]);

            // 管理画面の一覧に戻る
            return redirect()->route('admin.index');
        }

    // 詳細表示（FN023）
        public function show($id)
        {
            $contact = Contact::with('category')->findOrFail($id);

            return response()->json($contact);

        }

    // 削除（FN011）
        public function delete($id)
        {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return redirect()->route('admin.index')->with('success', '削除しました');
        }

    // CSV エクスポート（FN024）
        public function export()
        {
            $contacts = Contact::with('category')->orderBy('created_at', 'desc')->get();

            $csvName = 'contacts_' . date('Ymd') . '.csv';

        // CSV ヘッダー
            $csvData = "ID,名前,性別,メールアドレス,電話番号,住所,建物名,種類,内容,登録日\n";

            foreach ($contacts as $contact) {

        // 性別ラベル変換
                $genderLabel = '';
                if ($contact->gender == 1) $genderLabel = '男性';
                if ($contact->gender == 2) $genderLabel = '女性';
                if ($contact->gender == 3) $genderLabel = 'その他';

            $csvData .= implode(",", [
                $contact->id,
                $contact->last_name . ' ' . $contact->first_name,
                $genderLabel,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                optional($contact->category)->content,
                $contact->detail,
                $contact->created_at,
            ]) . "\n";
        }

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', "attachment; filename={$csvName}");
}


    // 検索条件をqueryに適用する共通メソッド
        private function applySearchConditions($query, $search)
        {
            //
        }
}
