<?php

try
{

    $delete = $_POST['id'];
    // $delete = 101;

    $delete = htmlspecialchars($delete,ENT_QUOTES,' UTF-8');

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user ,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM todo WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $delete ,PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;

}
catch (Exception $e)
{
    echo $e->getLine ();
    echo "</br>";
    echo $e->getMessage ();
    echo 'ただいま障害により大変ご迷惑をお掛けしております。 ';
    exit();
    
}