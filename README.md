# お問い合わせフォーム

## 環境構築
- Dockerのビルドからマイグレーション、シーディングまでを記述する
git clone git@github.com:coachtech-material/laravel-docker-template.git  
docker-compose up -d --build  
laravelのパッケージインストール（laravelの環境構築)  
docker-compose exec php bash  
.env.exampleファイルから.envファイルを作成し、環境変数を変更  
php artisan key:generate  
php artisan make:migration create_categories_table  
php artisan make:migration create_contacts_table  
※uesrsテーブルは既に作成されていたものを使用  
php artisan migrate  
php artisan db:seed  
php artisan db:seed --class=ContactsTableSeeder(エラーになり実行できなかったファイルを指定して再度実行  


## 使用技術(実行環境)
- laravel 8.75  
- MySQL 8.0  
- PHP7.4.9  
## ER図
< - - - 作成したER図の画像 - - - >

## URL
開発環境：http://localhost/  
Myadminphp：http://localhost:8080/  
