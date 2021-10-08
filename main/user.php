<?php 
    session_start();
    
    $u_id = $_SESSION['user_id'];
    $u_name = $_SESSION['user_name'];
    $errmsg = [];
    $offset = 1;
    
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
            'root', '');
        
        //情報取得
        $sql = $pdo->prepare('SELECT * FROM user_info WHERE user_id=?');
        $sql->execute([$u_id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        print $e->getMessage();
        exit();
    }
?>

<?php 
/*------ アイコンの変更開始 ------*/
    if(isset($_REQUEST['img_change'])){
        if(is_uploaded_file($_FILES['icon']['tmp_name'])){
            
            //user_img生成
            $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
            $create_id = str_shuffle($data);
            $image = substr($create_id, 0, 5);
            $image .= '.jpg';
            
            //user_img確認用呼び出し
            $sql_confirm = $pdo->prepare('SELECT user_img FROM user_info WHERE user_img=?');
            $sql_confirm->execute([$image]);
            $imgResult = $sql_confirm->fetch(PDO::FETCH_ASSOC);
            
            //user_imgがすでにあった場合、違う部分の文字列を返す
            while (!empty($imgResult)) {
                $image = substr($create_id, $offset, 5);
                $image .= '.jpg';
                
                $sql_confirm = $pdo->prepare('SELECT user_img FROM user_info WHERE user_img=?');
                $sql_confirm->execute([$image]);
                $imgResult = $sql_confirm->fetch(PDO::FETCH_ASSOC);
                $offset++;
            }
            
            //user_infoテーブルの変更
            $sql_img = $pdo->prepare('UPDATE user_info SET user_img=? WHERE user_id=?');
            $sql_img->execute([$image, $u_id]);
            
            //画像保存場所変更
            $file_p = 'img/' . $image;
            if(move_uploaded_file($_FILES['icon']['tmp_name'], $file_p)){
                header('Location: http://localhost/new/main/user.php');
            }
        }else{
            array_push($errmsg, 'ファイルを選択してください。');
        }
    }
/*------アイコンの変更終了------*/
        
    
/*------プロフィールの変更開始------*/
    if (isset($_REQUEST['profile_change'])) {
        $new_profile = $_REQUEST['new_profile'];
        
        //user_infoテーブルの変更
        $sql_profile = $pdo->prepare('UPDATE user_info SET profile=? WHERE user_id=?');
        $sql_profile->execute([$new_profile, $u_id]);
        
        header('Location: http://localhost/new/main/user.php');
    }
/*------プロフィールの変更終了------*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザページ</title>
    <link href="style.css" rel="stylesheet" media="all"><!--基本の設定-->
    <link href="button.css" rel="stylesheet" media="all"><!--各種ボタンの設定-->
    <link href="http://fonts.googleapis.com/css?family=Limelight">
    <style type="text/css">
        .userpage{
            text-align: center;
        }
    </style>
</head>
<body>

        <nav>
          <ul class="menu">
            <li><a href="home.php">　　　　HOME 　　　　</a></li>
            <li><a href="toukou.php">　　　　  投稿 　　　　</a></li>
            <li><a href="rank.php">　　　ランキング　　　</a></li>
            <li><a href="box.php">　スクラップボックス　</a></li>
            <li><a href="user.php">　　ユーザページ　　</a></li>
          </ul>
        </nav>

		<section class="userpage">
    		<?php 
    		  print '<h2>ユーザ名: ' . $result['user_name'] . '</h2>';
    		  print '<img src="img/' . $result['user_img'] . '" width="200" height="200">';
    		  print '<h2>ユーザコメント</h2> ';
    		  print $result['profile'] . '<hr>';
    		?>
    		<h2>アイコンの変更</h2>
    		<form action="" method="post" enctype="multipart/form-data">
    			<input type="file" name="icon">
    			<input type="submit" value="変更" name="img_change">
    		</form>
    		
    		<h2>コメントの変更</h2>
    		<form action="" method="post">
    			<textarea name="new_profile" rows="10" cols="60" placeholder="120文字以内" maxlength="120"></textarea>
    			<input type="submit" name="profile_change" value="変更">
    		</form>
		</section>
    <footer>

    </footer>
</body>
</html>