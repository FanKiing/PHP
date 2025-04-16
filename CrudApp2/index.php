<?php
require 'db.php';
require 'navbar.php';

$etudiants = $pdo->query("SELECT * FROM etudiants")->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <tr>
        <th>CEF</th><th>Nom Complet</th><th>Filière</th><th>Genre</th><th>Image</th><th>Actions</th>
    </tr>
    <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['cef'] ?></td>
            <td><?= $etudiant['fullName'] ?></td>
            <td><?= $etudiant['filiere'] ?></td>
            <td><?= $etudiant['genre'] ?></td>
            <td><img src="uploads/<?= $etudiant['image'] ?>" width="60"></td>
            <td>
                <a href="edit.php?cef=<?= $etudiant['cef'] ?>">Edit</a> |
                <a href="delete.php?cef=<?= $etudiant['cef'] ?>" onclick="return confirm('Supprimer cet étudiant ?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
