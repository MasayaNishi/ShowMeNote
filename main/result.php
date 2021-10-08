<?php
    session_start();
    
    /*
        $u_id = $_SESSION['user_id'];
        $u_name = $_SESSION['user_name'];
    */
    
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=showmenote2; charset=utf8',
            'root', '');
        
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
      <h2 class="h">
      <?php 
          if(!empty($_REQUEST['keyword'])){
              print '"' . $_REQUEST['keyword'] . '"の';
          }
      ?>
	  検索結果</h2>


		<?php 
    		//現在のページ数を取得する（未入力の場合は1を挿入）
    		if (isset($_REQUEST['page'])) {
    		    $page = (int)$_REQUEST['page'];
    		} else {
    		    $page = 1;
    		}
    		
    		// スタートのポジションを計算する
    		if ($page > 1) {
    		    //２ページ目の場合は、『(2 × 10) - 10 = 10』
    		    $start = ($page * 10) - 10;
    		} else {
    		    $start = 0;
    		}
    		
    		//SQL文作成
    		if(isset($_REQUEST['keyword'])){
    		    //ページング
    		    $page_num = $pdo->prepare('SELECT COUNT(*) FROM note WHERE note_id like ?');
    		    $page_num->execute(['%' . $_REQUEST['keyword'] . '%']);
    		    $page_num = $page_num->fetchColumn();
    		    $pagination = $page_num / 10;
    		    $pagination = ceil($page_num / 10);
    		    
    		    //ノート情報取得
    		    $sql = $pdo->prepare("SELECT * FROM note WHERE note_id like ? ORDER BY ランキングポイント合計 DESC LIMIT {$start}, 10");
    		    $sql->execute(['%' . $_REQUEST['keyword'] . '%']);
    		    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
    		    
    		}else{
    		    //ページング
    		    $page_num = $pdo->prepare('SELECT COUNT(*) FROM note');
    		    $page_num->execute([]);
    		    $page_num = $page_num->fetchColumn();
    		    $pagination = $page_num / 10;
    		    $pagination = ceil($page_num / 10);
    		    
    		    //ノート情報取得
    		    $sql = $pdo->prepare("SELECT * FROM note ORDER BY ランキングポイント合計 DESC LIMIT {$start}, 10");
    		    $sql->execute([]);
    		    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
    		}
		  
		      foreach ($sql as $row){
		          //user_info情報取得
		          $sql2 = $pdo->prepare('SELECT * FROM user_info WHERE user_id=?');
		          $sql2->execute([$row['user_id']]);
		          $result = $sql2->fetch(PDO::FETCH_ASSOC);
		          
		          //画面表示
		          print '<section>';
		          print '<img src="img/' . $result['user_img'] . '" width="80" height="80" class="img-round imgL"><br>';
		          print '<h3 class="h-sub">ユーザ名：' . $result['user_name'] . '</h3>';
		          print '<a href ="./detail.php?note_id=' . $row['note_id'] . '">';
		          print '<section id="ログイン">';
		          print '<strong>タイトル：' . $row['note_id'] . '</strong>';
		          print '<p class="time">' . $row['time'] . '</p>';
		          print '<span>#' . $row['tag_name'] . '</span>';
		          print '</section>';
		          print '</a>';
		          print '</section>';
		      }
		      
		      //aタグ作成(ページング)
		      for($i=1; $i<=$pagination; $i++){
		          print '<a href="result.php?page=' . $i . '">' . $i . '</a>';
		      }
		?>
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
