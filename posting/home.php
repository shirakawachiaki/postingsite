<!-- ホーム画面 -->
<?php
require('../dbconnect.php');
session_start();

if(isset($_SESSION['id']) && !is_null($_SESSION['id'])&& $_SESSION['time'] + 3600 > time()){
    $articles = $db->query('select m.icon, a.* from members m,articles a where m.id = a.member_id order by id desc limit 0,3');
    if(!$articles){
        die ($db->error);
    }

    $_SESSION['time'] =time();
    $sub_name= $_SESSION['sub_name'];
}else{
    header('Location:../login/login.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostingSite</title>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
        <a href="home.php"><img src="../images/title.PNG" alt="食と旅と"></a>
        </div>
        <nav>
            <ul class="global_nav">
                <li><a href="home.php">ホーム画面</a></li>
                <li><a href="post_all.php">投稿一覧</a></li>
                <li><a href="input.php">新規投稿の作成</a></li>
                <li><a href="../login/login.php">ログイン画面へ戻る</a></li>

            </ul>
        </nav>
    </header>
    <div id ="wrap">
        <div class="content">
            <h2>WELCOME *<?php echo $sub_name?>*</h2>
            <p><img src="../member_picture/<?php echo htmlspecialchars($_SESSION['icon'],ENT_QUOTES);?>" width="100" alt="アイコン画像" ></p>
            <article>
                <?php if(empty($articles)):?>
                    <p>投稿はありません</p>
                <?php else:?>
                    <h2>◯最新の投稿◯</h2>
                    <?php while($article= $articles->fetch_assoc()): ?>
                        <div>
                            <p>投稿者:<img src="../member_picture/<?php echo htmlspecialchars($article['icon'],ENT_QUOTES);?>" width="50" alt="アイコン画像" /></p>
                            <h2><a href="post.php?id=<?php echo  $article['id']; ?>"><?php echo htmlspecialchars($article['title']);?></a></h2>
                            <p><img src="../article_photos/<?php echo htmlspecialchars($article['photo']);?>" width="300" alt="投稿画像" /><p>
                            <p><?php echo htmlspecialchars($article['article']);?></p>
                            <p><a href="post.php?id=<?php echo $article['id'];?>">コメントする</a></p>
                            <time><?php echo htmlspecialchars($article['created']);?></time>
                        </div>
                        <hr>
                    <?php endwhile; ?>
                    <p>→<a href="post_all.php">投稿一覧へ</a></p>
                <?php endif; ?>
            </article>
        </div>
    </div>
    <footer></footer>
</body>
</html>