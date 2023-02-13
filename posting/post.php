<!-- 投稿の詳細を表示 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostingSite</title>
</head>
<body>
<?php
require('../dbconnect.php');
$stmt = $db->prepare('select * from articles where id =?');
if(!$stmt){
    die ($db->error);
}
$id =filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    echo '表示する投稿を指定してください';
    exit();
}
$stmt->bind_param('i',$id);
$stmt->execute();
$stmt->bind_result($id,$title,$article,$created);
$result = $stmt->fetch();
if(!$result){
    echo '投稿は見つかりませんでした';
    exit();
}
?>
<div>
    <h2><?php echo htmlspecialchars($title); ?></h2>
    <p><?php echo htmlspecialchars($article); ?></p>
</div>
<p><a href="update.php?id=<?php echo $id; ?>">投稿を編集する</a> | 
<a href="delete.php?id=<?php echo $id; ?>">投稿を削除する</a> | 
<a href="post_all.php">投稿一覧へ戻る</a></p>
</body>
</html>