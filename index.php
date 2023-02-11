<!-- ホーム画面 -->
<?php
require('dbconnect.php');
$articles = $db->query('select * from articles order by id desc limit 0,5');
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
    <h1>旅と食</h1>
    <p>→<a href="input.html">投稿を作成する</a></p>
    <p>→<a href="login.php">ログイン画面へ戻る</a></p>
    <?php if(!$articles):?>
        <p>投稿はありません</p>
    <?php else:?>
        <h2>◯最新の投稿◯</h2>
        <?php while($article= $articles->fetch_assoc()): ?>
        <div>
            <h2><a href="post.php?id=<?php echo  $article['id']; ?>"><?php echo htmlspecialchars($article['title']);?></a></h2>
            <p><?php echo htmlspecialchars($article['article']);?></p>
            <time><?php echo htmlspecialchars($article['created']);?></time>
        </div>
        <hr>
        <?php endwhile; ?>
        <p>→<a href="post_all.php">投稿一覧へ</a></p>
    <?php endif; ?>
