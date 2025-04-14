<?php
require_once 'functions.php';
if (isset($_GET['add'])) {
    addToCart($_GET['add']);
    header('Location: index.php');
    exit();
}
$products = getProducts();
?>
<?php include 'Navbar.php'; ?>

<h2>Produits</h2>
<div style="display:flex; gap:20px;">
    <?php foreach ($products as $p): ?>
        <div style="border:1px solid #ccc; padding:10px;">
            <img src="<?= $p['image'] ?>" width="100"><br>
            <strong><?= $p['intitule'] ?></strong><br>
            Prix: <?= $p['prix'] ?> DH<br>
            <a href="?add=<?= $p['id'] ?>">Ajouter au panier</a>
        </div>
    <?php endforeach; ?>
</div>
