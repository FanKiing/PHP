<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Liste des utilisateurs</h2>
    <table class="table table-bordered">
        <tr>
            <th>Image</th><th>Nom</th><th>Email</th><th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><img src="<?= $row['image']; ?>" width="70" height="70"></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
