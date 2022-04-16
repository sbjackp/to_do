<?php

$done = $_POST['id'];

try
{
    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user ,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM todo WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $done ,PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if($data[0]['done'] == 0){
        $newdone = 1;
    } 
    else {
        $newdone = 0;
    }

    echo $newdone;
   


    $sql = 'UPDATE todo SET done = :done WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam( ':done', $newdone, PDO::PARAM_STR);
    $stmt->bindParam( ':id', $done, PDO::PARAM_STR);
    $stmt->execute();
    



    $dbh = null;

}
catch (Exception $e)
{

    echo $e->getMessage ();
    echo 'ただいま障害により大変ご迷惑をお掛けしております。 ';
    exit;
    
}