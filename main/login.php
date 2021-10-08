<?php
    session_start();

    if(isset($_REQUEST['login'])){
        
        $id = $_REQUEST['user_id'];
        $pwd = $_REQUEST['password'];

        try{
            $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
                'root', '');
            $sql = $pdo->prepare('SELECT * FROM user WHERE BINARY user_id=? AND BINARY password=?');
            $sql->execute([$id, $pwd]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $sql = NULL;
            $pdo = NULL;

            if($result != NULL){
                
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['user_name'] = $result['user_name'];
                
                header('Location: http://localhost/new/main/home.php');
                exit();
                
            }else{
                print 'ユーザIDまたはパスワードが誤りです。';
            }

        } catch (PDOException $e){
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
    <title>ログイン</title>
</head>
<body>
    <head>

    </head>
    <main>
            <form action="" method="post">
            	<table>
                    <tr>
    	                <td><input placeholder="ユーザID" type="text" name="user_id" /></td>
                    </tr>
                    <tr>
    	                <td><input placeholder="パスワード" type="password" name="password" /></td>
                    </tr>
                    <tr>
            			<td><input type="submit" name="login" value="ログイン"></td>
            		</tr>
            	</table>
            </form>
    </main>
    <footer>

    </footer>
</body>
</html>