<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "crud_db";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>
