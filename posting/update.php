<!-- 投稿の編集 -->
<?php
require('../dbconnect.php');
$stmt = $db->prepare('select * from articles where id=?');
if(!$stmt){
    die ($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    echo '投稿が指定されていません';
    exit();
}
$stmt->bind_param('i', $id);
$result =$stmt->execute();
if(!$result){
    die($db->error);
}
$stmt->bind_result($id,$member_id,$title,$article,$photo,$created,$modified);
$stmt->fetch();


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
    <h2>投稿の編集</h2>

    <form action="update_do.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <textarea name="title" cols="50" rows="2" placeholder="タイトルを入力"><?php echo htmlspecialchars($title);?>
        </textarea><br>
        <textarea name="article" cols="100" rows="20" placeholder="投稿を入力"><?php echo htmlspecialchars($article);?>
        </textarea><br>
        <button type="submit">変更する</button>
    </form>

    <p>→<a href="home.php">ホーム画面に戻る</a></p>

</body>
</html>