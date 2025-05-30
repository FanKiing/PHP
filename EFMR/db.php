<?php
$server = 'localhost';
$dbname = 'stock';
$login = 'root';
$password = '';
$connexion = new PDO("mysql:host=$server;dbname=$dbname;", $login, $password);

$sql = "SELECT * FROM GestionProducts";
$res = $connexion ->query($sql)
?>