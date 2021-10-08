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
    <li><a href="user.php">　　ユーザページ　　</a></li>
  </ul>
</nav>
<!--　ここまでが基本ヘッダー　-->

<main id="contents">　<!--白枠開始-->
    <section id="intro" class="clearfix">
      <h2 class="h">ランキング</h2>


		<?php 
		  //ポイント上位10件のnote情報取得
		  $i = 1;
		  $sql = $pdo->prepare('SELECT * FROM note ORDER BY ランキングポイント合計 DESC LIMIT 10');
		  $sql->execute([]);
		  
		      foreach ($sql as $row){
		          //user_info情報取得
		          $sql2 = $pdo->prepare('SELECT * FROM user_info WHERE user_id=?');
		          $sql2->execute([$row['user_id']]);
		          $result = $sql2->fetch(PDO::FETCH_ASSOC);
		          
		          //画面表示
		          print '<section>';
		          print '<h2 class="h-sub">' . $i . '位</h2>';
		          print '<img src="user_img/' . $result['user_img'] . '" width="80" height="80" class="img-round imgL"><br>';
		          print '<h3 class="h-sub">ユーザ名：' . htmlspecialchars($result['user_name']) . '</h3>';
		          print '<a href ="./detail.php?note_id=' . $row['note_id'] . '">';
		          print '<section id="ログイン">';
		          print '<strong>タイトル：' . htmlspecialchars($row['note_id']) . '</strong>';
                  print '<p class="time">' . $row['time'] . '</p>';
                  print '<span>#' . htmlspecialchars($row['tag_name']) . '</span>';
		          print '</section>';
		          print '</a>';
		          print '</section>';
		          $i++;
		      }

		?>

<!-- 
      <section>
        <h2 class="h-sub">1位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">2位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">3位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">4位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">5位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">6位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">7位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">8位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">9位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>

      <section>
        <h2 class="h-sub">10位</h2>
        <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
        <h3 class="h-sub">ユーザー名</h3>
        <a href ="name.html">
        <section id="ログイン">
          <strong>タイトル</strong><p　class="time">　時間//右揃えにしたい</p>
            <span>#キーワード　#キーワード  </span>
         </section>
        </a>
      </section>
      
-->
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
