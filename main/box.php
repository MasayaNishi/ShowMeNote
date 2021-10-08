<?php 
    session_start();
    
    $u_id = $_SESSION['user_id'];
    $u_name = $_SESSION['user_name'];
    
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
            'root' ,'');
        
    } catch (PDOException $e) {
        print $e->getMessage();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>show me note！</title>
<meta name="keywords" content="にゃんこ,ネコ,ねこ,猫,ねこ紹介,ねこ自慢">
<meta name="description" content="我が家のアイドル、にゃんこ達を紹介します！可愛い猫写真を沢山掲載しています。">
<link href="style.css" rel="stylesheet" media="all"><!--基本の設定-->
<link href="box.css" rel="stylesheet" media="all"><!--各種ボタンの設定-->
<link href="http://fonts.googleapis.com/css?family=Limelight">
</head>

<body>
  <div id="roguin">
    <a href="login.php" class="roguin-botan">
      ログイン
    </a>

    <a href="regist.php" class="touroku-botan">
      会員登録
    </a>
  </div>

  <header>
  <a href="home.php"> <img src="img/rogo.png" width="1000" height="200" alt="show me note!" class="rogo"></a>
  </header>

<nav>
  <ul class="menu">
    <li><a href="home.php">　　　　HOME 　　　　</a></li>
    <li><a href="toukou.php">　　　　  投稿 　　　　</a></li>
    <li><a href="rank.php">　　　ランキング　　　</a></li>
    <li><a href="box.php">　スクラップボックス　</a></li>
  </ul>
</nav>
<!--　ここまでが基本ヘッダー　-->

<main id="contents">　<!--白枠開始-->
    <section id="intro" class="clearfix">

        <main>
         <form action="" method="post">
          <table>
            <tr>
              <td><input placeholder="検索" type="text" name="keyword"/></td>
              <td><input type="submit" name="search" value="検索"></td>
            </tr>
          </table>
         </form>
        </main>
        <strong></strong>
      </section>
      <h2 class="h">スクラップボックス</h2>

		<?php 
		
		  //検索
    		if(isset($_REQUEST['search'])){
    		    if(isset($_REQUEST['keyword'])){
    		        $sql = $pdo->prepare('SELECT * FROM trim WHERE user_id=? AND trim_id like ? ');
    		        $sql->execute([$u_id, '%' . $_REQUEST['keyword'] . '%']);
    		    }
    		}else{
    		    $sql = $pdo->prepare('SELECT * FROM trim WHERE user_id=?');
    		    $sql->execute([$u_id]);
    		}
    	?>
    	<?php
    	//画像表示
    		foreach ($sql as $row){
    		    print '<img src="img/' . $row['trim_image_id'] . '" width="460" height="300" class="gazou">';
    		}
		?>
<!-- 
      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou">
      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou"><br><br>

      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou">
      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou"><br><br>

      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou">
      <img src="http://placehold.jp/fff/b9b9b9/460x300.png?text=画像" class="gazou">
 -->

    </main>

<!--ここから基本フッター-->
<a href="" class="btn btn--circle btn--circle-c btn--shadow">
  <i class="fas fa-arrow-up"></i>
  ↑
</a>
<footer>

  <p><small>Copyright c KOMA-NATSU Web All Rights Reserved.</small></p>
</footer>
</body>
</html>
