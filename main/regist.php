<?php 
    session_start();
    
    if(isset($_REQUEST['regist'])){
        
        $id = $_REQUEST['user_id'];
        $name = $_REQUEST['user_name'];
        $pwd = $_REQUEST['password'];
        
        try {
            $pdo = new PDO('mysql:host=localhost; dbname=showmenote; charset=utf8',
                'root', '');
            $sql= $pdo->prepare('SELECT user_id FROM user WHERE user_id=?');
            $sql->execute([$id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($id && $name && $pwd)){
                if(empty($result['user_id'])){
                    $sql = "";
                    $sql = $pdo->prepare('INSERT INTO user VALUES(?, ?, ?)');
                    $sql->execute([$id, $name, $pwd]);
                    
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $name;
                    
                    header('Location: http://localhost/ShowMeNote2/main/home.php');
                    
                    
                }else{
                    print 'このユーザIDは使われています。';
                }
                
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
        <table>
            <form action="" method="post">
                <tr>
	                <td><input placeholder="ユーザID" type="text" name="user_id"/></td>
                </tr>
	                <td><input placeholder="ユーザ名" type="text" name="user_name"/></td>
                <tr>
	                <td><input placeholder="パスワード" type="password" name="password"/></td>
                </tr>
                <tr>
                	<td><input type="submit" name="regist" value="登録"></td>
                </tr>
            </form>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>