<?php


try {
    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user ,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->query('SELECT * FROM todo ORDER BY created_at ASC');
    $res = $stmt->execute();
    $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // error_log ('内容');
    // error_log ('$lists: ' . print_r ($lists, true));
    // var_dump($lists);
    echo json_encode($lists);
    // echo json_encode('テスト');
    

    $dbh = null;
} catch (Exception $e) {
        echo $e->getMessage ();

        // 更新書き込みを防ぐ
        // echo 'ただいま障害により大変ご迷惑をお掛けしております。 ';
        exit();
}



?>