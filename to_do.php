<?php

$task = filter_input(INPUT_POST,'task');

// $task = $_POST['task'];
// 困ったらjsonでどこまで来てるか確認
// echo json_encode($task);
// exit;

error_log ('$task: ' . print_r (mb_strlen($task), true));
// exit;
// ターミナルでエラーログを見る
// tail -f php_error.log

try
{
    


    if(mb_strlen($task) === 0){
        $data = [
            'status' => 'error',
            'message' => 'Bタスクを入力して下さい'
        ];
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    } elseif(mb_strlen($task) >= 10){
        $data = [
            'status' => 'error',
            'message' => 'Bタスクは10文字以内で入力して下さい'
        ];
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user ,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO todo (task) VALUES (:task)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam( ':task', $task, PDO::PARAM_STR);
    $stmt->execute();

    $dbh = null;

}
catch (Exception $e)
{
    $data = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;

    // echo $e->getMessage ();
    // echo 'ただいま障害により大変ご迷惑をお掛けしております。 ';
    // exit;
    
}

$data = [
    'status' => 'success',
    'message' => 'B成功'
];

header('Content-type: application/json; charset=utf-8');
echo json_encode($data);
exit;


?>