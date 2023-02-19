<!-- 投稿の詳細を表示 -->
<?php
session_start();
require('../dbconnect.php');
$sub_name= $_SESSION['sub_name'];
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
            <?php
            $post_id =filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
            if(!$post_id){
                echo '表示する投稿を指定してください';
                exit();
            }
            $comments = $db->query('select c.comment, c.post_id, c.created from comments c, articles a where c.post_id = a.id ');
            if(!$comments){
                die ($db->error);
            }
            $icons = $db->query('select m.icon  from comments c, members m where c.member_id = m.id ');
            if(!$icons){
                die ($db->error);
            }

            $stmt = $db->prepare('select * from articles where id =?');
            if(!$stmt){
                die ($db->error);
            }


            $stmt->bind_param('i',$post_id);
            $stmt->execute();
            $stmt->bind_result($post_id,$member_id,$title,$article,$photo,$created,$modified);
            $result = $stmt->fetch();
            if(!$result){
                echo '投稿は見つかりませんでした';
                exit();
            }
            ?>
            <div>
                <h2>WELCOME *<?php echo $sub_name?>*</h2>
                <p><img src="../member_picture/<?php echo htmlspecialchars($_SESSION['icon'],ENT_QUOTES);?>" width="100" alt="アイコン画像" ></p>
                <article>
                    <h2><?php echo trim(htmlspecialchars($title)); ?></h2>
                    <p><img src="../article_photos/<?php echo htmlspecialchars($photo);?>" width="300" alt="投稿画像" /><p>
                    <p><?php echo trim(htmlspecialchars($article)); ?></p>
                </article>
            </div>
            <p>
                <a href="post_all.php">投稿一覧へ戻る</a> |
                <a href="update.php?id=<?php echo $post_id; ?>">投稿を編集する</a> | 
                <a href="delete.php?id=<?php echo $post_id; ?>">投稿を削除する</a>
            </p>
            <br>
            <form action="comment_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo $post_id;?>">
                <textarea name=" comment" cols=50" rows="3" placeholder="コメントを入力"></textarea><br>
                <button type="submit">送信する</button>
            </form>
            <div>
                <?php while($comment= $comments->fetch_assoc()): ?>
                    <?php if($comment['post_id'] == $post_id):?>
                        <p>
                            <?php echo htmlspecialchars($comment['comment']);?> |
                            <?php echo htmlspecialchars($comment['created']);?>
                        </p>
                        <p>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
                    <?php endif;?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>