<!-- 投稿受け取り画面 -->

<?php
// 一旦記事だけ表示
$title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_SPECIAL_CHARS);
$article = filter_input(INPUT_POST,'article',FILTER_SANITIZE_SPECIAL_CHARS);

require('../dbconnect.php');
$stmt = $db->prepare('insert into articles(title,article) values (?,?)');
// $stmt = $db->prepare('insert into articles(article) values (?)');
if(!$stmt){
    die ($db->error);
}
$stmt->bind_param('ss',$title,$article);
$ret =$stmt->execute();
if($ret){
    echo '投稿が完了しました。';
    echo '<br>→<a href="home.php">ホームに戻る</a>';
}else{
    echo $db->error;
}
?>