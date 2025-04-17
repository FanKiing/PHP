<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <style>
        img { width: 60px; height: 60px; border-radius: 50%; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        nav { margin-bottom: 20px; }
    </style>
</head>
<body>

<nav>
    <a href="index.php" class="btn btn-info">Accueil</a> |
    <a href="create.php">Ajouter un étudiant</a>
</nav>

<h2>Liste des étudiants</h2>

<table>
    <tr>
        <th>Image</th>
        <th>Nom complet</th>
        <th>Filière</th>
        <th>Site Web</th>
        <th>Email</th>
        <th>Genre</th>
        <th>Loisirs</th>
        <th>Actions</th>
    </tr>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM etudiants");
     $etudiants = mysqli_fetch_all($result, MYSQLI_ASSOC); 

foreach($etudiants as $etudiant):?>
    
    <tr>
                <td><img src="<?= $etudiant['image']?>" alt=''></td>
                <td><?= $etudiant['fullname']?></td>
                <td><?= $etudiant['filiere']?></td>
                <td><a href="<?= $etudiant['siteweb']?>" target='_blank'><?= $etudiant['fullname']?></a></td>
                <td><?= $etudiant['email']?></td>
                <td><?= $etudiant['genre']?></td>
                <td><?= $etudiant['loisirs']?></td>
                <td>
                    <a href="edit.php?num=<?=$etudiant['num']?>">Modifier</a> |
                    <a href="delete.php?num=<?= $etudiant['num']?>" onclick="return confirm('sure???')">Supprimer</a>
                </td>
              </tr>";
    <?php endforeach; ?>
    
</table>

</body>
</html>































