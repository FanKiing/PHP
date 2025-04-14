<?php
require_once 'functions.php';
?>
<nav>
    <a href="index.php">Accueil</a> |
    <a href="panier.php">
        🛒 Panier (<span><?= getCartCount(); ?></span>)
    </a>
</nav>
<hr>
