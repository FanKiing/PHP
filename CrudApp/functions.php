<?php
session_start();

function getProducts() {
    return [
        ["id" => 1, "intitule" => "Produit A", "prix" => 100, "image" => "images/produitA.jpg"],
        ["id" => 2, "intitule" => "Produit B", "prix" => 150, "image" => "images/produitB.jpg"],
        ["id" => 3, "intitule" => "Produit C", "prix" => 200, "image" => "images/produitC.jpg"]
    ];
}

function addToCart($id) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

function removeFromCart($id) {
    unset($_SESSION['cart'][$id]);
}

function updateCartQuantity($id, $quantity) {
    if ($quantity <= 0) {
        removeFromCart($id);
    } else {
        $_SESSION['cart'][$id] = $quantity;
    }
}

function getCartCount() {
    return array_sum($_SESSION['cart'] ?? []);
}
