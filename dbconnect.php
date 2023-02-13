<!-- データベース -->

<?php
try{
    $db = new mysqli('localhost:8889','root', 'root','mydb');
}catch(PDOException $e){
    echo 'DB接続エラー:'.$e->getMessage();
}
?>