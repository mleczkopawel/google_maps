<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 29.03.2016
 * Time: 15:09
 */
try
{
    $pdo=new PDO('mysql:host=localhost;dbname=map','root','zaq');
    $pdo->query("SET NAMES 'utf8'");
    $pdo->query("SET CHARSET 'utf8'");
    $pdo->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
}
catch(PDOException $e)
{
    echo "połączenie nie zostało utworzone: ".$e->getMessage();
}
//    $id = trim($_GET['id']);
    $pdo->query("SET NAMES 'utf8'");//TO MUSI BYĆ W WIELU MIEJSCACH BO INACZEJ UCIEKNĄ ZNAKI POLSKIE...
    $wynik = $pdo -> query("SELECT * FROM map_data");
    $wynik -> setFetchMode(PDO::FETCH_ASSOC);
    $ress = $wynik->fetchAll();
    $json = json_encode($ress);
    echo $json;
//    header("Location:../app_dev.php");


//}