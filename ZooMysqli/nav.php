<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user'])) {
    header("Location: authentification.php");
    exit();
}
?>
<nav>
    <a href="home.php">Home</a> |
    <a href="listeVisite.php">Liste des visites</a> |
    Connecté en tant que : <?= $_SESSION['user']['email']; ?>
</nav>
<hr>
