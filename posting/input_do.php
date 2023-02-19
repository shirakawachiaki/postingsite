<!-- 投稿受け取り画面 -->
<?php
session_start();
$login_member_id = $_SESSION['id']; 

if($_POST['title'] != '' && $_POST['article'] != ''){
    $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_SPECIAL_CHARS));
    $article =trim(filter_input(INPUT_POST,'article',FILTER_SANITIZE_SPECIAL_CHARS));
    $photoName = $_FILES['photo']['name'];
    if(!empty($photoName)){
        if(substr($photoName,-3) != 'jpg' && substr($photoName,-3) !='gif' && substr($photoName,-4) != 'jpeg'){
            header('Location: input.php');
            exit();
        }
        $photo =date('YmdHis').$photoName;

        move_uploaded_file($_FILES['photo']['tmp_name'], '../article_photos/'.$photo);
    }else{
        header('Location: input.php'); 
        exit();
    }
    require('../dbconnect.php');
    $stmt = $db->prepare('insert into articles(member_id, title,photo,article) values (?,?,?,?)');
    if(!$stmt){
        die ($db->error);
    }
    $stmt->bind_param('isss',$login_member_id, $title, $photo ,$article);
    $ret =$stmt->execute(); 
    if($ret){
        echo '投稿が完了しました。';
        echo '<br>→<a href="home.php">ホームに戻る</a>';
    }else{
        echo $db->error;
    }
}else{
        header('Location: input.php');     
}
?>