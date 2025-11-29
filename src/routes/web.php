<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;


// =============================
// ユーザー側（お問い合わせ）
// =============================

//お問合せトップ. 入力フォーム
Route::get('/', [ContactController::class, 'index']);

//確認画面
Route::post('/confirm', [ContactController::class, 'confirm']);

Route::get('/confirm', function () {
    return redirect()->route('contact.index');
});

//完了画面
Route::post('/thanks', [ContactController::class, 'store']);

// =============================
// 管理画面
// =============================

//一覧
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// 詳細表示（FN023：モーダル用 JSON / HTMLどちらでも）※必要なら
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');

// 検索
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');

// 検索リセット
Route::get('/reset', [AdminController::class, 'reset'])->name('admin.reset');

// 削除
Route::post('/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

// CSV エクスポート
Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
