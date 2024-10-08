## アプリケーション名
coachtechフリマ。<br>
![index](https://github.com/user-attachments/assets/fd7dbfdb-d309-41dc-bc5e-4694aa07e7f3)
ある企業が開発した独自のフリマアプリ。
## 作成した目的
coachtechブランドのアイテムを出品する。<br>
初年度のユーザー数1000人達成。
## アプリケーションURL
https://github.com/shimezi/coachtech-freema
## 他のリポジトリ
## 機能一覧
会員登録<br>
ログイン<br>
商品一覧取得<br>
商品詳細取得<br>
商品お気に入り一覧取得<br>
ユーザー情報取得<br>
ユーザー購入商品一覧取得<br>
ユーザー出品商品一覧取得<br>
プロフィール変更<br>
商品お気に入り追加<br>
商品お気に入り削除<br>
商品コメント追加<br>
商品コメント削除<br>
出品<br>
-- 以下追加項目 --<br>
管理画面<br>
メール送信<br>
ストレージ<br>

## 使用技術(実行環境)
Laravel Framework 8.83.8<br>
PHP 7.4.9<br>
MySQL 8.0.26
## テーブル設計
![スクリーンショット 2024-10-08 210641](https://github.com/user-attachments/assets/972e9702-75a7-4260-84fe-e62f9dfd76a4)
![スクリーンショット 2024-10-08 210658](https://github.com/user-attachments/assets/002354d4-55cf-44e7-92af-481cea455ac5)
![スクリーンショット 2024-10-08 210710](https://github.com/user-attachments/assets/4e026825-3457-469b-8b6d-f7b403189747)
## ER図
![ER2](https://github.com/user-attachments/assets/39cf0b03-0dd7-4a77-9893-10123827f6aa)
# 環境構築
Dockerビルド<br>
1.git clone git@github.com:shimezi/coachtech-freema.git<br>
2.DockerDesktopアプリを立ち上げる<br>
3.docker-compose up -d --build<br>
<br>
Laravel環境構築<br>
1.docker-compose exec php bash<br>
2.composer install<br>
3.「.env.example」を 「.env」に名称変更。<br>
4.「.env」の変更点は以下<br>

DB_CONNECTION=mysql<br>
DB_HOST=mysql DB_PORT=3306<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>

5.アプリケーションキーの作成<br>
php artisan key:generate<br>
6.マイグレーションの実行<br>
php artisan migrate<br>
7.シーディングの実行<br>
php artisan db:seed<br>
8.コントローラーの作成<br>
php artisan make:controller<br>
9.モデルの作成<br>
php artisan make:model<br>
10.リクエストファイルの作成<br>
php artisan make:request<br>
11.ビューファイルを作成<br>
touch ○○.blade.php<br>
12.cssファイルを作成<br>
touch ○○.css
## 他に記載することがあれば記述する
adminのページ
localhost/admin/<br>
管理者メールアドレス:admin@gmail.com<br>
管理者パスワード:adminadmin<br>
一般ユーザーメールアドレス:aaa@gmail.com<br>
一般ユーザーメールアドレス:aaaaaaaa
