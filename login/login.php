<!-- ログイン画面 -->
<?php
require('../dbconnect.php');

session_start();

// if(isset($_COOKIE['id']) && $_COOKIE['id'] !==''){
//     $_POST['id'] = $_COOKIE['id'];
//     $_POST['pass'] = $_COOKIE['pass'];
//     $_POST['save'] = 'on';
// }

if(!empty($_POST)){

    $login_id = $_POST['login_id'];
    $pass = sha1($_POST['pass']);
    if( $login_id !== '' && $pass !== ''){
        $login = $db->prepare('select id,sub_name, icon from members where login_id=? and password=?');
        if(!$login){
            die ($db->error);
        }
        $login->bind_param('ss',$login_id, $pass);
        $login->execute();
        $login->bind_result($id,$sub_name, $icon);
        $member = $login->fetch();


        if($member){
            $_SESSION['id'] = $id;
            $_SESSION['sub_name'] =$sub_name;
            $_SESSION['icon'] = $icon;
            $_SESSION['time'] = time();

            // if($_POST['save'] == 'on'){
            //     setcookie('id', $_POST['login_id'], time()+60*60*24*10);
            //     setcookie('pass', $_POST['pass'], time()+60*60*24*10);
            // }
            header('Location:../posting/home.php');
            exit();
        }else{
            $error['login'] = 'failed';
        }
    }else{
        $error['login'] = 'blank';
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
    <h1>旅と食</h1>
    <h2>ログイン</h2>
    <!-- action属性後で入力 -->
    <form action="" method="post">
        <dt>ログインID</dt>
        <dd>
            <?php if(isset($_POST['login_id'])):?>
                <input type="id" name="login_id" maxlength="50" placeholder="ログインIDを入力" 
                    value="<?php echo htmlspecialchars($_POST['login_id'],ENT_QUOTES);?>">
            <?php else: ?>
                <input type="id" name="login_id" maxlength="50" placeholder="ログインIDを入力"?>
            <?php endif; ?>
            <?php if(isset($error['login']) && $error['login'] == 'blank'):?>
                <p class ='error'>ログインIDとパスワードを記入してください</p>
            <?php elseif(isset($error['login']) && $error['login'] == 'failed'): ?>
                <p class ='error'>ログインIDまたはパスワードが間違っています</p>
            <?php endif;?>
                
        </dd>    
        <dt>PASSWORD</dt>
        <dd>
            <input type="password" name="pass" maxlength="50" placeholder="パスワードを入力" >
        </dd>    
        <dt>自動ログイン</dt>
        <dd>
            <input id="save" type="checkbox" name="save" value="on">
            <label for="save">次回から自動ログインをする</label>
        </dd>
        <button type="submit">ログイン</button>
    </form>

    <p>→<a href="account_new.php">新規登録はこちら</a></p>
    
</body>
</html>