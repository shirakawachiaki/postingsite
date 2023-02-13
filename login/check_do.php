<?php
session_start();
require('dbconnect.php');

if(!empty($_POST)){
    $stmt = $db->prepare('insert into members(name, read_name, sub_name, login_id, password, birthday, icon) values(?,?,?,?,?,?,?)');
}
if(!$stmt){
    die ($db->error);
}
$secret = $_SESSION['join']['password'];
$stmt->bind_param('sssssss',
    $_SESSION['join']['name'],
    $_SESSION['join']['read_name'],
    $_SESSION['join']['sub_name'],
    $_SESSION['join']['login_id'],
    sha1($secret),
    $_SESSION['join']['birthday'],
    $_SESSION['join']['icon']);
$success = $stmt->execute();
if($success){
    echo '登録が完了しました。';
    echo '<br>→<a href="login.php">ログイン画面へ</a>';
}else{
    echo $db->error;
}
unset($_SESSION['join']);

?>