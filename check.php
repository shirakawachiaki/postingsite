<!-- 会員登録情報の確認 -->
<?php
session_start();

if(!$_SESSION['join']){
    header('Location:account_new.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostingSite</title>
</head>
<body>
    <form action="" method="post">
        <dl>
            <dt>名前</dt>
            <dd></dd>
            <dt>名前(ふりがな)</dt>
            <dd></dd>
            <dt>ニックネーム</dt>
            <dd></dd>
            <dt>ログインID</dt>
            <dd></dd>
            <dt>パスワード</dt>
            <dd></dd>
            <dt>生年月日</dt>
            <dd></dd>
            <dt>アイコン画像</dt>
            <dd></dd>
        </dl>
        <div><a href="account_new.php?action=rewrite">修正する</a> | <button type="submit">登録する</button></div>
    </form>
</body>
</html>