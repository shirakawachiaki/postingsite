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
</head>
<body>
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

    <p>→<a href="home.php">ホーム画面に戻る</a></p>
</body>
</html>