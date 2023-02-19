<!-- 投稿作成画面 -->
<?php
session_start();
$sub_name= $_SESSION['sub_name'];
$login_member_icon= $_SESSION['icon']

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostingSite(投稿)</title>
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
            <div>
                <h2><?php echo $sub_name?>の投稿</h2>
                <p><img src="../member_picture/<?php echo htmlspecialchars($_SESSION['icon'],ENT_QUOTES);?>" width="100" alt="アイコン画像" ></p>
            </div>
            <form action="input_do.php" method="post" enctype="multipart/form-data">
                <textarea name="title" cols="50" rows="2" placeholder="タイトルを入力"></textarea><br>
                <textarea name="article" cols=100" rows="20" placeholder="投稿を入力"></textarea><br>
                <input type="file" name="photo" accept=".jpg, .jpeg" ><br>
                <button type="submit">投稿する</button>
            </form>
        </div>
    </div>
    <footer></footer>
</body>
</html>