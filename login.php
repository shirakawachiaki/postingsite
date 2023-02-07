<!-- ログイン画面 -->
<?php
session_start();

$id='';
$pass='';
$date =array(
    'id' =>'shirakawa',
    'pass'=>'chiaki'
);

if(!empty($_POST)){
    $id = $_POST['id'];
    $pass = $_POST['pass'];
}

if($date['pass'] === $pass){
    $_SESSION['id'] = $id;
    header('Location:index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>postingsite</title>
</head>
<body>
    <h1>旅と食</h1>
    <h2>ログイン</h2>
    <!-- action属性後で入力 -->
    <form action="" method="post">
        <p>ログインID <input type="id" name="id" placeholder="ログインIDを入力"></p>
        <p>PASSWORD <input type="password" name="pass" placeholder="パスワードを入力"></p>
        <button type="submit">ログイン</button>
    </form>

    <p>→<a href="account_new.html">新規登録はこちら</a></p>
    
</body>
</html>