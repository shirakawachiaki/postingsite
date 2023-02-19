<?php
require('../dbconnect.php');

if($_POST['title'] !== '' && $_POST['article'] !== ''){
$stmt = $db->prepare('update articles set title=?, article=? where id=?');
if(!$stmt){
    die($db->error);
}
$id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
$title=filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$article=filter_input(INPUT_POST, 'article', FILTER_SANITIZE_SPECIAL_CHARS);
$stmt->bind_param('ssi', $title, $article,$id);
$success =$stmt->execute();
if(!$success){
    die($db->error);
}
header('Location: post.php?id='.$id);
}else{
    header('Location: update.php?id='.$id);
}

?>