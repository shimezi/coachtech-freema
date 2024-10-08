## アプリケーション名
coachtechフリマ。<br>
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

管理画面
ストレージ

## 使用技術(実行環境)
Laravel Framework 8.83.8<br>
PHP 7.4.9<br>
MySQL 8.0.26
## テーブル設計
## ER図
![ER2](https://github.com/user-attachments/assets/39cf0b03-0dd7-4a77-9893-10123827f6aa)
# 環境構築
Dockerビルド

1.git clone git@github.com:shimezi/coachtech-freema.git 2.DockerDesktopアプリを立ち上げる 3.docker-compose up -d --build

Laravel環境構築
1.docker-compose exec php bash
2.composer install
3.「.env.example」を 「.env」に名称変更。
4.「.env」の変更点は以下

DB_CONNECTION=mysql DB_HOST=mysql DB_PORT=3306 DB_DATABASE=laravel_db DB_USERNAME=laravel_user DB_PASSWORD=laravel_pass

5.アプリケーションキーの作成
php artisan key:generate
6.マイグレーションの実行
php artisan migrate
7.シーディングの実行
php artisan db:seed
8.コントローラーの作成
php artisan make:controller
9.モデルの作成
php artisan make:model
10.リクエストファイルの作成
php artisan make:request
11.ビューファイルを作成
touch ○○.blade.php
12.cssファイルを作成
touch ○○.css
## 他に記載することがあれば記述する


[def]: https://github.com/user-attachments/assets/39cf0b03-0dd7-4a77-9893-10123827f6aa