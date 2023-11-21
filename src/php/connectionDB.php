<?php
$server= 'localhost';
$user = 'root';
$password='root';
$dbname='CAISSE-SMT';

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo 'connexion successfuly';
} catch (PDOException $e) {
    echo 'probleme de connexion db: '.$e->getMessage();
}

?>
