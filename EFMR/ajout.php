<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"];
    $designation = $_POST["designation"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

}

?>

<div class="container">
    <h1>Gestion dse produits</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="code">saisir le code du produit :</label>
        <input type="text" id="code" name="code">
        <br>
        <label for="designation">saisir la désignation du produit :</label>
        <input type="text" id="designation" name="designation">
        <br>
        <label for="price">saisir le prix du produit :</label>
        <input type="text" id="price" name="price">
        <br>
        <label for="stock">saisir le stock du produit :</label>
        <input type="text" id="stock" name="stock">
        <br>
        <button type="submit">Ajouter</button>
    </form>
</div>