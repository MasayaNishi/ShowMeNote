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
        $sql = $pdo->prepare('SELECT * FROM user_info WHERE u_id=?');
        $sql->execute([$u_id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        print $e->getMessage();
        exit();
    }
?>

<?php 
/*------アイコンの変更開始------*/
    if(isset($_REQUEST['アイコンの変更'])){
        if(is_uploaded_file($_FILES['icon']['tmp_name'])){
            //user_img生成
            $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
            $create_id = str_shuffle($data);
            $image = substr($create_id, 0, 6);
            $image .= '.jpg';
            
            //user_img確認用呼び出し
            $sql_confirm = $pdo->prepare('SELECT user_img FROM user_info WHERE user_img=?');
            $sql_confirm->execute([$image]);
            $imgResult = $sql_confirm->fetch(PDO::FETCH_ASSOC);
            
            //user_imgがすでにあった場合、違う部分の文字列を返す
            while (!empty($imgResult)) {
                $image = substr($create_id, $offset, 6);
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
            if(move_uploaded_file($_FILES['file']['tmp_name'], $file_p)){
                header('Location: http://localhost/new/main/user.php');
            }
        }else{
            array_push($errmsg, 'ファイルを選択してください。');
        }
    }
/*------ アイコンの変更終了 ------*/
    
    
/*------ユーザ名の変更開始------*/
    if(isset($_REQUEST['ユーザ名変更ボタン'])){
        $new_name = $_REQUEST['new_name'];
        
        //user_infoテーブルの変更
        $sql_name = $pdo->prepare('UPDATE user_info SET user_name=? WHERE user_id=?');
        $sql_name->execute([$new_name, $u_id]);
        
        //userテーブルの変更
        $sql_user = $pdo->prepare('UPDATE user SET user_name=? WHERE user_id=?');
        $sql_user->execute([$new_name, $u_id]);
        
        header('Location: http://lcoalhost/new/main/user.php');
    }
/*------ユーザ名の変更終了------*/
    
    
/*------プロフィールの変更開始------*/
    if (isset($_REQUEST['プロフィール変更ボタン'])) {
        $new_profile = $_REQUEST['new_profile'];
        
        //user_infoテーブルの変更
        $sql_profile = $pdo->prepare('UPDATE user_info SET profile=? WHERE user_id=?');
        $sql_profile->execute([$new_profile, $u_id]);
        
        header('Location: http://lcoalhost/new/main/user.php');
    }
/*------プロフィールの変更終了------*/
?>