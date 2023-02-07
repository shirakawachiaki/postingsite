<!-- 投稿の削除 -->

<?php
require('dbconnect.php');
$stmt = $db->prepare('delete from articles where id=?');
if(!$stmt){
    die('$db->error');
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    echo '投稿を指定してください';
    exit;
}
$stmt->bind_param('i', $id);
$success =$stmt->execute();
if(!$success){
    die($db->error);
}

header('Location: delete_do.html');

?>