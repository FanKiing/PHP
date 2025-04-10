<?php
session_start();

$id = $_GET['id'];
$user = $_SESSION['users'][$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['users'][$id] = [
        'nom' => $_POST['nom'],
        'email' => $_POST['email']
    ];
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Modifier un utilisateur</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" >
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
