<?php

include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

/*if ($user['userType']) {
    $stmt = mysqli_prepare($conn, "SELECT todos.*, categories.name as category, users.name as username FROM todos 
        JOIN categories ON todos.category_id = categories.id 
        JOIN users ON todos.user_id = users.id");
} else {
    $stmt = mysqli_prepare($conn, "SELECT todos.*, categories.name as category FROM todos 
        JOIN categories ON todos.category_id = categories.id 
        WHERE todos.user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user['id']);
}*/
$stmt = mysqli_prepare($conn, "SELECT todos.*, categories.name as category, users.name as username FROM todos 
JOIN categories ON todos.category_id = categories.id 
JOIN users ON todos.user_id = users.id");

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    

<h2>Liste des Todos</h2>
<p>Bienvenue <?= htmlspecialchars($user['name']) ?> | <a href="logout.php" class="btn btn-primary">Se déconnecter</a></p>

<a href="create.php"> Ajouter Todo</a>
<table class="table table-hover">
    <tr>
        <th>Titre</th><th>Description</th><th>Catégorie</th>
        <?php if ($user['userType']): ?><th>Utilisateur</th><?php endif; ?>
        <th>Actions</th>
    </tr>
    <?php foreach ($todos as $todo): ?>
        <tr>
            <td><?= htmlspecialchars($todo['title']) ?></td>
            <td><?= htmlspecialchars($todo['description']) ?></td>
            <td><?= htmlspecialchars($todo['category']) ?></td>
            <?php if ($user['userType']): ?>
                <td><?= htmlspecialchars($todo['username']) ?></td>
            <?php endif; ?>
            <td>
                <?php if ($user['userType'] || $todo['user_id'] == $user['id']): ?>
                    <a href="edit.php?id=<?= $todo['id'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $todo['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
                <?php else: ?>
                    Non autorisé
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>