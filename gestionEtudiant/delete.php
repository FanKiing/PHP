<?php
include 'db.php';

$num = $_GET['num'];
mysqli_query($conn, "DELETE FROM etudiants WHERE num=$num");

header("Location: index.php");
?>
