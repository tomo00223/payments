ELITES実務案件　決済システム開発

1.担当した機能
  企業の担当者が支払内容と顧客情報に応じた個別の決済ページを発行し、
  顧客がその決済ページにアクセスして決済を行う
  決済はクレジットカードで決済する
  決済後、個別の決済ページにはアクセスできないようにする

2.担当した画面・仕様
・個別決済ページ発行画面
  /payments/admin/generateでアクセス

  ◯画面にはBASIC認証を設定(設定はID:admin, パスワード:password)
  ◯フォームに7項目を入力し、Submit後、バリデーションエラー発生時はそのエラーを表示する。
  ◯問題ない場合は、フォームに入力したメールアドレスに個別決済ページのURLと個別決済ページにアクセスするためのIDとパスワードを送り、個別決済ページ発行完了画面に遷移する。また、ルーティング設定ファイルに、発行した個別決済ページにアクセスできるように設定を追記する。

・個別決済ページ発行完了画面
  /payments/admin/generatedでアクセス

  ◯フォームに入力した内容を再表示する。
  ◯1度のみの課金か、定期課金かで表示を切り替える。

・個別決済ページ
  /payments/key/個別決済ページ毎の乱数 でアクセス

  ◯画面にはBASIC認証を設定(設定はID:ID, パスワード:password)
  ◯クレジットカード情報を入力し、チェックボックスの同意するをチェックする。Submit後、バリデーションエラー発生時はそのエラーを表示する。
    バリデーションエラーがないが、何かしらのエラーが発生した際は、申込失敗画面へ遷移する。
  ◯問題ない場合は、WEBPAYのAPIを利用してクレジットカード情報を含む課金情報をWEBPAYサーバーに登録する。また、顧客情報をWEBPAYサーバー及び自社のサーバーに登録する。
    その後、ルーティング設定ファイルを、個別決済ページへアクセスできないように設定する。
    全て問題なく終了したら、申込完了画面へ遷移する。
  ◯個別決済ページ発行後、24時間経過した場合は、個別決済ページにアクセスした際にエラーを表示し、該当ページにアクセスできないようにする。また、URLの個別決済ページ毎の乱数が誤っている場合にはエラーを表示する。