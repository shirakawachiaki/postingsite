<!-- 会員登録情報の確認 -->
<?php
session_start();

if(!$_SESSION['join']){
    header('Location:account_new.php');
    exit();
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
    <form action="check_do.php" method="post">
        <input type="hidden" name="action" value="submit"/>
        <dl>
            <dt>名前</dt>
            <dd>
                <?php echo htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES);?>
            </dd>
            <dt>名前(ふりがな)</dt>
            <dd>
                <?php echo htmlspecialchars($_SESSION['join']['read_name'],ENT_QUOTES);?>
            </dd>
            <dt>ニックネーム</dt>
            <dd>
                <?php echo htmlspecialchars($_SESSION['join']['sub_name'],ENT_QUOTES);?>
            </dd>
            <dt>ログインID</dt>
            <dd>
                <?php echo htmlspecialchars($_SESSION['join']['login_id'],ENT_QUOTES);?>
            </dd>
            <dt>パスワード</dt>
            <dd>
                パスワードは表示されません。
            </dd>
            <dt>生年月日</dt>
            <dd>
                <?php echo htmlspecialchars($_SESSION['join']['birthday'],ENT_QUOTES);?>
            </dd>
            <dt>アイコン画像</dt>
            <dd>
                <p><img src="./member_picture/<?php echo htmlspecialchars($_SESSION['join']['icon'],ENT_QUOTES);?>" width="100" alt="アイコン画像" /><p>
            </dd>
        </dl>
        <div><a href="account_new.php?action=rewrite">修正する</a> | <button type="submit">登録する</button></div>
    </form>
</body>
</html>