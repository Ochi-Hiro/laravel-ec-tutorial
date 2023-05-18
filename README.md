## udemy Laravel講座

## インストール方法

## インストール後の実施事項

画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg ~ sample6.jpgとして
保存しています。

php artisan storage:link で
storageフォルダにリンク後、

storage/app/public/products フォルダ内に
保存すると表示されます。
(productsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shopフォルダを作成し
画像を保存してください。

## section7捕捉

決済のテストとしてstrioeを利用しています。
必要な場合は.envにstripeの情報を追記してください。

## section8捕捉

メールのテストとしてmailtrapを利用しています。
必要な場合は.envにmailtrapの情報を追記してください。

メール処理には時間がかかるので、
キューを使用しています。

必要な場合はphp artisan queue:workで
ワーカーを立ち上げて動作確認するようにしてください。