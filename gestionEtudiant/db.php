<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "gestion_etudiants";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
    //die arrête le script en affichant un message d'erreur
}
?>
