<?php
    //DB接続
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=showmenote; charset=utf8',
            'root', '');
        
    } catch (PDOException $e) {
        print $e->getMessage();
        exit();
    }
    
    //SQL文作成
    if(isset($_REQUEST['keyword'])){
        $sql = $pdo->prepare('SELECT * FROM note WHERE note_id like ? ORDER BY ランキングポイント合計 DESC');
        $sql->execute(['%' . $_REQUEST['keyword'] . '%']);
        
    }else{
        $sql = $pdo->prepare('SELECT * FROM note ORDER BY ランキングポイント合計 DESC');
        $sql->execute([]);
    }
    
    //画面表示
    print '<h1>検索結果</h1>';
    
    if (!empty($_REQUEST['keyword'])) {
        print 'キーワード: ' . $_REQUEST['keyword'] . ' の検索結果<hr>';
    }

        print '<table>';
        print '<tr>';
        print '<th>タイトル　　</th><th>ユーザID　　</th><th>ランキングポイント</th>';
        print '</tr>';
        
        foreach ($sql as $row){
            print '<tr>';
            print '<td><a href="./detail.php?note_id=' . $row['note_id'] . '">' . $row['note_id'] . '</a></td>';
            print '<td>' . $row['user_id'] . '</td>';
            print '<td>' . $row['ランキングポイント合計'] . '</td>';
            print '</tr>';
        }
        
        print '</table>';
    
    print '<hr>';
    print '<a href="./home.php">ホーム</a>';
?>