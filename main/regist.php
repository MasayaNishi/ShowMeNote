<?php 
    session_start();
    
    if(isset($_REQUEST['regist'])){
        
        $id = $_REQUEST['user_id'];
        $name = $_REQUEST['user_name'];
        $pwd = $_REQUEST['password'];
        
        try {
            $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
                'root', '');
            $sql= $pdo->prepare('SELECT user_id FROM user WHERE user_id=?');
            $sql->execute([$id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($id && $name && $pwd)){
                /*
                //パスワードの検証(半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上50文字以下)
                if(preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/', $pwd)){
                */
                    if(empty($result['user_id'])){
                        //userテーブルに追加
                        $sql = "";
                        $sql = $pdo->prepare('INSERT INTO user VALUES(?, ?, ?)');
                        $sql->execute([$id, $name, $pwd]);
                        
                        //user_infoテーブルに追加
                        $sql2 = $pdo->prepare('INSERT INTO user_info VALUES(:id, :name, :img_name, null)');
                        $sql2->bindValue(':id', $id);
                        $sql2->bindValue(':name', $name);
                        $sql2->bindValue(':img_name', '00000.jpg');
                        $sql2->execute();
                        
                        $_SESSION['user_id'] = $id;
                        $_SESSION['user_name'] = $name;
                        
                        header('Location: http://localhost/new/main/home.php');
                        
                        
                    }else{
                        print 'このメールアドレスは既に使用されています。';
                    }
                /*
                }else{
                    print 'パスワードは、半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上100文字以下にしてください。';
                }
                */
            }else{
                print 'すべて入力して下さい。';
            }
            
        } catch (PDOException $e) {
            print $e->getMessage();
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>新規登録</title>
</head>
<body>
    <head>

    </head>
    <main>
       <h1>新規登録</h1>
       <form action="" method="post">
           <table>
               <tr>
        	   	<td><input placeholder="メールアドレス" type="email" name="user_id"/></td>
               </tr>
               <tr>
        	   	<td><input placeholder="ユーザ名" type="text" name="user_name"/></td>
        	   </tr>
               <tr>
        	   	<td><input placeholder="パスワード" type="password" name="password"/></td>
               </tr>
               <tr>
               	<td><input type="submit" name="regist" value="登録"></td>
               </tr>
           </table>
       </form>
    </main>
    <footer>

    </footer>
</body>
</html>