<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>show me note！</title>
<meta name="keywords" content="にゃんこ,ネコ,ねこ,猫,ねこ紹介,ねこ自慢">
<meta name="description" content="我が家のアイドル、にゃんこ達を紹介します！可愛い猫写真を沢山掲載しています。">
<link href="style.css" rel="stylesheet" media="all"><!--基本の設定-->
<link href="toukou.css" rel="stylesheet" media="all"><!--投稿　css-->
<linl href="http://fonts.googleapis.com/css?family=Limelight">
</head>

<body>
    <div id="roguin">
        <a href="roguin.html" class="roguin-botan">
          ログイン
        </a>

        <a href="touroku.html" class="touroku-botan">
          会員登録
        </a>
      </div>

      <header>
      <a href="home.html"> <img src="img/rogo.png" width="1000" height="200" alt="show me note!" class="rogo"></a>
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
      <div><p><input type="text"  class="taitoru" name="title" placeholder="タイトル"  ></p></div>

        <div><p><input type="text" class="tagu" name="tag" placeholder="タグ" ></p></div>

        <div><p><img src="http://placehold.jp/800x450.png?text=画像" class="gazou"></p></div>

        <div id="preview"></div>
        <label for="example" id="tuika" class="btn btn-flat">
            <span>画像の追加</span>
            <input type="file" id="example" class="file_upload"　accept=".png, .jpeg, jpg">
            <script src="toukou.js"></script>
         </label>

        <a  class="btn btn--yellow btn--border-dashed">スクラップボックス</a>

        <br><br>

        <label for="submit" class="btn btn-border">
          <span>投稿</span>
          <input type="submit">
         </label>

      </section>
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
