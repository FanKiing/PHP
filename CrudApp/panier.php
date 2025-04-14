<?php
require_once 'functions.php';

$products = getProducts();
$cart = $_SESSION['cart'] ?? [];

if (isset($_GET['incre'])) {
    $cart[$_GET['incre']]++;
}
if (isset($_GET['decre'])) {
    $cart[$_GET['decre']]--;
    if ($cart[$_GET['decre']] <= 0) {
        unset($cart[$_GET['decre']]);
    }
}
if (isset($_GET['delete'])) {
    $cart = array_filter($cart, fn($qte, $key) => $key != $_GET['delete'], ARRAY_FILTER_USE_BOTH);
}
$_SESSION['cart'] = $cart;
?>
<?php include 'Navbar.php'; ?>

<h2>Votre Panier</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Image</th>
        <th>Intitulé</th>
        <th>Prix Unitaire</th>
        <th>Quantité</th>
        <th>Prix HT</th>
        <th>Actions</th>
    </tr>
    <?php
    $montantTotal = array_reduce(array_keys($cart), function ($total, $id) use ($products, $cart) {
        $product = array_values(array_filter($products, fn($p) => $p['id'] == $id))[0];
        return $total + $product['prix'] * $cart[$id];
    }, 0);

    foreach ($cart as $id => $qte):
        $product = array_values(array_filter($products, fn($p) => $p['id'] == $id))[0];
    ?>
        <tr>
            <td><img src="<?= $product['image'] ?>" width="50"></td>
            <td><?= $product['intitule'] ?></td>
            <td><?= $product['prix'] ?> DH</td>
            <td>
                <a href="?decre=<?= $id ?>">➖</a>
                <?= $qte ?>
                <a href="?incre=<?= $id ?>">➕</a>
            </td>
            <td><?= $qte * $product['prix'] ?> DH</td>
            <td><a href="?delete=<?= $id ?>">🗑️ Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Total : <?= $montantTotal ?> DH</h3>
