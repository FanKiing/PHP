<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT todos.*, categories.name AS category FROM todos 
         JOIN categories ON todos.category_id = categories.id 
        WHERE todos.id = $id";
$result = $conn->query($sql);
$todo=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Détail du Todo</h2>
    <p><strong>Titre :</strong> <?= $todo['title'] ?></p>
    <p><strong>Description :</strong> <?= $todo['description'] ?></p>
    <p><strong>Catégorie :</strong> <?= $todo['category'] ?></p>
    <a href="index.php" class="btn btn-primary">Retour</a>
</div>
</body>
</html>
