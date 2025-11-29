# お問い合わせフォーム（Laravel）  

このアプリケーションは、COACHTECH 課題で作成した Laravel 製の「お問い合わせフォーム」アプリです。  
Docker 環境上で Laravel を動作させ、入力 → 確認 → 完了 → 管理画面 まで一連の流れを実装しています。

---

## 🛠 環境構築

### ▼ Docker ビルド手順
```bash
git clone <あなたのリポジトリURL>
cd <プロジェクト名>
docker-compose up -d --build
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

使用技術（実行環境）
	•	PHP 8.x
	•	Laravel 8.x
	•	MySQL 8.x
	•	nginx
	•	jQuery 3.x（バリデーション確認用）
	•	Docker / docker-compose

URL（開発環境）
	•	お問い合わせフォーム（入力）：http://localhost/
	•	ユーザー登録ページ：http://localhost/register
	•	管理者ログイン：http://localhost/login
	•	phpMyAdmin：http://localhost:8889/

ER図

作成した ER 図を以下に貼っています。
![ER図](./er.png)

機能一覧

▼ ユーザー側
	•	フォーム入力
	•	確認画面
	•	バリデーション（フロント + サーバー）
	•	完了画面

▼ 管理側
	•	ログイン（Laravel Fortify）
	•	問い合わせ一覧表示
	•	詳細表示
	•	問い合わせの検索機能（名前・メール・性別・種類・日付範囲）
	•	問い合わせの削除
	•	CSV エクスポート

ディレクトリ構成（主要部分）
/app
/resources/views
/routes/web.php
/database/migrations
/database/seeders

注意事項
	•	マイグレーションとテーブル仕様書が一致していることを確認済み
	•	フロント・管理画面ともに動作確認済み
	•	Docker 上で clone → build → migrate → seed が可能な構成になっています