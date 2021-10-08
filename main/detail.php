<?php
    session_start();
    
    /*
        $u_id = $_SESSION['user_id'];
        $u_name = $_SESSION['user_name'];
    */
    
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
            'root', '');
        //noteテーブルから情報取得
        $sql = $pdo->prepare('SELECT * FROM note WHERE note_id=?');
        $sql->execute([$_REQUEST['note_id']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        print $e->getMessage();
        exit();
    }
    
    if(isset($_REQUEST['いいね'])){
        $points = $result['ランキングポイント合計'] + 1;
        $sql_points = $pdo->prepare('UPDATE note SET ランキングポイント合計=? WHERE note_id=?');
        $sql_points->execute([$points, $_REQUEST['note_id']]);
        
        header('Location: http://localhost/new/main/detail.php?note_id=' . $result['note_id']);
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
<link href="rank.css" rel="stylesheet" media="all"><!--各種ボタンの設定-->
<link href="http://fonts.googleapis.com/css?family=Limelight">
</head>

<body>

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
      <h2 class="h"><?php print $_REQUEST['note_id'];?></h2>
      
      <?php 
        //画面表示
        print '<img src="img/' . $result['image_id'] . '" width="460" height="300">';
        print '#' . $result['tag_name'];
        print 'ランキングポイント: ' . $result['ランキングポイント合計'];
      ?>
      <form action="" method="post">
      	<input type="submit" name="いいね" value="いいね">
      </form>
    </section>
    
    
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
