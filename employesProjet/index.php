<?php
$employes = json_decode(file_get_contents("employes.json"), true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Employés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <h1 class="mb-4">Liste des Employés</h1>
        <a href="add.php" class="btn btn-primary mb-4">Ajouter un Employé</a>
        <div class="row">
            <?php foreach ($employes as $employe): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?= $employe['image'] ?>" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($employe['nom']) ?></h5>
                            <p class="card-text">
                                Matricule : <?= $employe['matricule'] ?><br>
                                Email : <?= $employe['email'] ?><br>
                                <a href="<?= $employe['linkedin'] ?>" target="_blank">LinkedIn</a>
                            </p>
                            <a href="detail.php?matricule=<?= $employe['matricule'] ?>" class="btn btn-info btn-sm">Détails</a>
                            <a href="update.php?matricule=<?= $employe['matricule'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete.php?matricule=<?= $employe['matricule'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
