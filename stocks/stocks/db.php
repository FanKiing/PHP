<?php
$host="127.0.0.1:3307";
$root="root";
$password="";
$database="stocks";
$conn = mysqli_connect($host,$root,$password,$database);
// die(var_dump($conn));//retourne objet pour ce connecter a la base de donne ou false en cas derreur
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>