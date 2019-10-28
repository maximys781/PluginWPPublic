<?php

echo 'Privet Mir';
//return 'Привет мир!';
$host = 'localhost';
$db   = 'y98066hv_1';
$user = 'y98066hv_1';
$pass = 'KizpPD2Lmr';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
try {
$dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}
$name=$_POST['namepic'];
$descr=$_POST['descrrpic'];
$price=$_POST['pricepic'];
$hall=$_POST['hallpic'];

$insert = $pdo->query("INSERT INTO wp_pic1 (namepic, desrpic, pricepic, hallpic) VALUES (:namepic, :descrpic, :pricepic, :hallpic");


if ($insert->execute()) {
    echo "Данные добавлены в таблицу";
} else {
    echo "Неудачная запись";
}