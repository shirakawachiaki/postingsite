<!-- コメントの投稿 -->

<?php
require('../dbconnect.php');
session_start();
$login_member_id = $_SESSION['id']; 

if($_POST['comment'] != ''){
    $comment = trim(filter_input(INPUT_POST,'comment',FILTER_SANITIZE_SPECIAL_CHARS));
    $post_id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);

    $stmt = $db->prepare('insert into comments(post_id, member_id, comment) values (?,?,?)');
    if(!$stmt){
        die ($db->error);
    }
    $stmt->bind_param('iis',$post_id, $login_member_id, $comment);
    $success =$stmt->execute();
    if(!$success){
        die($db->error);
    }
    header('Location: post.php?id='.$post_id);
}else{
    header('Location:post.php');
}