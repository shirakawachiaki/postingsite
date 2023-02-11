<!-- アカウント登録 -->
<?php
session_start();

if(!empty($_POST)){
    if($_POST['name'] == ''){
        $error['name'] = 'blank';
    }
    if($_POST['read_name'] == ''){
        $error['read_name'] = 'blank';
    }
    if($_POST['sub_name'] == ''){
        $error['sub_name'] = 'blank';
    }
    if(strlen($_POST['login_id']) <4 ){
        $error['password'] ='length';
    }
    if($_POST['login_id'] == ''){
        $error['login_id'] = 'blank';
    }
    if(strlen($_POST['password']) < 4){
        $error['password'] ='length';
    }
    if($_POST['password'] == ''){
        $error['password'] = 'blank';
    }
    if($_POST['confirm_password'] !== $_POST['password']){
        $error['confirm_password'] ='wrong';
    }
    if($_POST['birthday'] == ''){
        $error['birthday'] = 'blank';
    }
    $fileName = $_FILES['icon']['name'];
    if(!empty($fileName)){
        $ext = substr($fileName,-3);
        if($ext != 'jpg' && $ext !='gif'){
            $error['icon'] = 'type';
        }
    }

    if(empty($error)){
        $icon =date('YmdHis').$_FILES['icon']['name'];
        move_uploaded_file($_FILES['icon']['tmp_name'], 'member_picture/'.$icon);

        $_SESSION['join'] =$_POST;
        $_SESSION['join']['icon'] = $icon;
        header('Location: check.php');
        exit;
    }
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
    <h2>新規登録</h2>
    <p>→<a href="login.php">ログイン画面へ戻る</a></p>

    <!-- action属性後で入力 -->
    <form action=" " method="post" enctype="multipart/form-data">
        <dl>
            <dt>名前</dt>
            <dd>
                <?php if(isset($_POST['read_name'])):?>
                    <input type="text" name="name" maxlength="30" placeholder="名前" 
                        value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?>">
                <?php else: ?>
                    <input type="text" name="name" maxlength="30" placeholder="名前">
                <?php endif; ?>
            </dd>
            <dt>名前(ふりがな)</dt>
            <dd>
                <?php if(isset($_POST['read_name'])):?>
                    <input type="text" name="read_name" maxlength="50" placeholder="ふりがな" 
                        value="<?php echo htmlspecialchars($_POST['read_name'],ENT_QUOTES);?>">
                <?php else: ?>
                    <input type="text" name="read_name" maxlength="50" placeholder="ふりがな"?>
                <?php endif; ?>

                <?php if(isset($error['read_name']) && $error['read_name'] == 'blank'):?>
                    <p class ='error'>*ふりがなを入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>ニックネーム</dt>
            <dd>
                <?php if(isset($_POST['sub_name'])):?>
                <input type="text" name="sub_name" maxlength="50" placeholder="ニックネーム" 
                    value="<?php echo htmlspecialchars($_POST['sub_name'],ENT_QUOTES);?>">
                <?php else: ?>
                    <input type="text" name="sub_name" maxlength="50" placeholder="ニックネーム"?>
                <?php endif; ?>

                <?php if(isset($error['sub_name']) && $error['sub_name'] == 'blank'):?>
                    <p class ='error'>*ニックネームを入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>ログインID</dt>
            <dd>
                <?php if(isset($_POST['login_id'])):?>
                <input type="text" name="login_id" maxlength="50" placeholder="半角英数4文字以上" 
                    value="<?php echo htmlspecialchars($_POST['login_id'],ENT_QUOTES);?>">
                <?php else: ?>
                    <input type="text" name="login_id" maxlength="50" placeholder="半角英数4文字以上"?>
                <?php endif; ?>

                <?php if(isset($error['login_id']) && $error['login_id'] == 'blank'):?>
                    <p class ='error'>*ログインIDを入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>パスワード</dt>
            <dd>
                <input type="password" name="password" maxlength="50" placeholder="半角英数4文字以上" >
                <?php if(isset($error['password']) && $error['password'] == 'blank'):?>
                    <p class ='error'>*ログインIDを入力してください</p>
                <?php elseif(isset($error['password']) && $error['password'] == 'length'):?>
                    <p class ='error'>*4文字以上で入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>パスワード再入力</dt>
            <dd>
                <input type="password" name="confirm_password" maxlength="50" placeholder="もう一度入力">
                <?php if(isset($error['confirm_password']) && $error['confirm_password'] == 'wrong'):?>
                    <p class ='error'>*正しく入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>生年月日</dt>
            <dd>
                <?php if(isset($_POST['birthday'])):?>
                    <input type="date" name="birthday" maxlength="50"
                    value="<?php echo htmlspecialchars($_POST['birthday'],ENT_QUOTES);?>">
                <?php else: ?>
                    <input type="date" name="birthday" maxlength="50"?>
                <?php endif; ?>

                <?php if(isset($error['birthday']) && $error['birthday'] == 'blank'):?>
                    <p class ='error'>*生年月日を入力してください</p>
                <?php endif; ?>
            </dd>
            <dt>アイコン画像</dt>
            <dd>
                <input type="file" name="icon" max="9999-12-31">
                <?php if(isset($error['icon']) && $error['icon'] == 'type'):?>
                    <p class ='error'>*写真は「.jpg]または「.gif」を指定してください</p>
                <?php elseif(!empty($error)):?>
                    <p class ='error'>*もう一度画像を選択してください</p>
                <?php endif; ?>
            </dd>

            <div><p><button type="submit">入力内容を確認する</button></p></div>
        </dl>
    </form>
</body>
</html>