<!-- 投稿の一覧を表示する -->
<?php 
require('../dbconnect.php');
$articles = $db->query('select * from articles order by id desc');
if(!$articles){
    die ($db->error);
}
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
    <h1>投稿一覧</h1>
<p>→<a href="home.php">ホーム画面に戻る</a></p>
<?php while($article= $articles->fetch_assoc()): ?>
        <div>
            <h2><a href="post.php?id=<?php echo $article['id'];?>"><?php echo htmlspecialchars($article['title']);?></a></h2>
            <p><?php echo htmlspecialchars($article['article']);?></p>
            <time><?php echo htmlspecialchars($article['created']);?>
        </div>
        <hr>
        <?php endwhile; ?>
</body>
</html>