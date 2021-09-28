<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>show me note！</title>
<meta name="keywords" content="にゃんこ,ネコ,ねこ,猫,ねこ紹介,ねこ自慢">
<meta name="description" content="我が家のアイドル、にゃんこ達を紹介します！可愛い猫写真を沢山掲載しています。">
<link href="style.css" rel="stylesheet" media="all"><!--基本の設定-->
<link href="button.css" rel="stylesheet" media="all"><!--各種ボタンの設定-->
<link href="http://fonts.googleapis.com/css?family=Limelight">
</head>

<body>
<header>
  <h1>show me note！<br>-ここにロゴが入ります-</h1>
  <p></p>
</header>

<nav>
  <ul class="menu">
    <li><a href="home.php">　　　　HOME 　　　　</a></li>
    <li><a href="toukou.php">　　　　  投稿 　　　　</a></li>
    <li><a href="rank.php">　　　ランキング　　　</a></li>
    <li><a href="box.php">　スクラップボックス　</a></li>
  </ul>
</nav>

<main id="contents">

<section id="intro">
  <h2 class="h">キーワード検索</h2>
  <main>
    <table>
    <form>
      <tr>
      <td><input placeholder="検索" type="text"/></td>
      </tr>
    </form>
    </table>
    
    <input type="button" name="regist" value="検索">
</main>
  <strong></strong></p>
</section>

<section id="cats" class="clearfix">
  <h2 class="h">投稿一覧</h2>

  <section id="ブロック-投稿">
    <img src="img/komachi.jpg" width="80" height="80" alt="小町" class="img-round imgL"><br>
    <h3 class="h-sub">ユーザー名<span></span></h3>
    <section id="ログイン">
      <strong>タイトル</strong>
      <p　class="time">時間//右揃えにしたい</p>
        <span>#キーワード　#キーワード  </span>
     </section>
    </section>

  <section>
    <h3 class="h-sub">ユーザー名<span></span></h3>
    <img src="img/konatsu.jpg" width="480" height="320" alt="小夏" class="imgR">
    <p class="ログイン">小町のお友達に、と1年後に貰われてきた次女・小夏。<br>
    埼玉県飯能市の炭鉱で生まれ育った元野生児。小町とは対照的に天真爛漫で社交的。よく食べ、よく遊び、よく眠る元気いっぱいな女の子。</p>
    <p class="more clear"><a href="cats/konatsu.html">もっと見る</a></p>
  </section>

</section>

<a href="" class="mae  btn  btn--circle-c">
  <i class="fas fa-arrow-up"></i>
    ← 
</a><!--
<a href="" class="botan1">
    1 
</a>
<a href="" class="tugi">
  → 
</a>-->

<!--
<section id="profile" class="clearfix">
  <h2 class="h">飼い主紹介</h2>
  <img src="img/avatar.png" width="250" height="250" alt="アバター画像" class="img-round imgL">
  <dl>
    <dt>H.N. ：</dt><dd>roka404</dd>
    <dt>仕事 ：</dt><dd>フリーランスでWeb関係のお仕事してます</dd>
    <dt>mail ：</dt><dd><a href="mailto:info@roka404.main.jp">info@roka404.main.jp</a></dd>
    <dt>Web ：</dt><dd><a href="http://roka404.main.jp/blog/" target="_blank">http://roka404.main.jp/blog/</a></dd>
  </dl>
</section>
-->
</main>

ボックスは
<a href="" class="btn btn--circle btn--circle-c btn--shadow">
  <i class="fas fa-arrow-up"></i>
  ↑ 
</a>
<footer>

  <p><small>Copyright c KOMA-NATSU Web All Rights Reserved.</small></p>
</footer>
</body>
</html>
