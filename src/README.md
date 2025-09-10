# 勤怠管理アプリ

# 開発環境

windows11
wsl ubuntu

### 使用技術

Laravel 8.x  
PHP  
MySQL
Docker

### 環境構築

1. git clone git@github.com:lecafoyokare/attendance.git
2. DockerDesktop アプリを立ち上げる
3. 名前の変更がなければカウントディレクトリを attendance のままにする
4. docker-compose up -d --build

以降カウントディレクトリは docker-compose up -d --build を行ったディレクトリの前提で説明を進めます。

#### Laravel 環境構築

1. docker-compose exec php bash 'php コンテナ内に入るためのコマンド

2 からは php コンテナ内でのコマンド実行 ※1 で成功していれば php コンテナ内に入っています

2. composer install 'composer のインストール
3. composer -v 'composer がインストールが出来ているか確認。成功していれば以下の表示が出ます。

![composerインストール確認画像](https://github.com/user-attachments/assets/5c39a929-5a1f-42f0-b8ed-a4886e731a63)

4. cp .env.example .env '.env.example ファイルをコピーし新たに.env ファイルを作成
5. code .
6. src ディレクトリ内の.env ファイルを開く
7. 以下のように変更

![スクリーンショット 2024-10-11 031118](https://github.com/user-attachments/assets/06954734-22a5-4810-b62a-d13b22fe0a04)

もし以下のようなエラーがでた場合は exit コマンドを入力しカウントディレクトリへ移動  
 次のコマンドを実行してください sudo chmod -R 777 src/.env  
 またパスワードを求められた際はパスワードを入力

![スクリーンショット 2024-10-11 031624](https://github.com/user-attachments/assets/44db8615-3d09-4c9c-ae2b-cee9e8172b61)

8. php artisan key:generate

9. ブラウザで localhost/login と検索。成功していれば以下のような画面になります。

![ログイン画面](https://github.com/user-attachments/assets/b0ae602a-657d-41f5-8e31-f22a22280599)

    もし以下のようなエラーがでた場合は exit コマンドを入力しカウントディレクトリへ移動
    次のコマンドを実行してください sudo chmod -R 777 src/\*
    またパスワードが求められた際はパスワードを入力

![スクリーンショット 2024-10-11 035146](https://github.com/user-attachments/assets/c12284bc-1027-464f-9ed8-eb7f2f01e3df)

#### テストデータの追加

1.カウントディレクトリで docker-compose exec php bash を入力し php コンテナに入り下記のコマンドを実行する  
 php artisan db:seed
