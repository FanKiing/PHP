<?php
session_start();


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Supprimer un user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['users'][$id]);
    $_SESSION['users'] = array_values($_SESSION['users']); // reindexer l array =>suppression par unset
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Liste des utilisateurs</h2>
    <a href="add.php" class="btn btn-success mb-3">Ajouter un utilisateur</a>
    <table class="table table-bordered">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($_SESSION['users'] as $index => $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?delete=<?= $index ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
