<?php
$host = "db.visite.ma";
$user = "admin";
$pass = "adminEM";
$dbname = "gestionVisite";

// Connexion
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Vérification
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
    //die =>  arrêter le script et afficher un msg
}
?>
