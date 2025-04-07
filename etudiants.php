<?php
if (isset($_COOKIE["etudiants"])) {
    $etudiants = json_decode($_COOKIE["etudiants"], true);
} else {
    $etudiants = [];
}

// Vérifier si on est en mode édition
$editIndex = $_GET["edit"] ?? null;
$editEtudiant = $editIndex !== null && isset($etudiants[$editIndex]) ? $etudiants[$editIndex] : null;

// Gestion du formulaire d'ajout et de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //if (isset($_POST["submit"])) {
    $nom = $_POST["nom"] ?? "";
    $prenom = $_POST["prenom"] ?? "";
    $age = $_POST["age"] ?? "";
    $classe = $_POST["classe"] ?? "";
    $id = $_POST["id"] ?? null;

    if (!empty($nom) && !empty($prenom) && !empty($age) && !empty($classe)) {
        if ($id !== null && isset($etudiants[$id])) {
            // Modification de l'étudiant existant
            $etudiants[$id] = ["nom" => $nom, "prenom" => $prenom, "age" => $age, "classe" => $classe];
        } else {
            // Ajout d'un nouvel étudiant
            $etudiants[] = ["nom" => $nom, "prenom" => $prenom, "age" => $age, "classe" => $classe];
            //array_push($etudiants,["nom" => $nom, "prenom" => $prenom, "age" => $age, "classe" => $classe]);
        }

        // Sauvegarde dans le cookie
        setcookie("etudiants", json_encode($etudiants), time() + 86400);
       
    
    }
}

// Suppression d'un étudiant
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    if (isset($etudiants[$id])) {
        array_splice($etudiants, $id, 1);
        setcookie("etudiants", json_encode($etudiants), time() + 86400);
        
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Gestion des Étudiants</h2>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="border p-4 shadow">
        <input type="hidden" name="id" id="id" value="<?php echo $editIndex !== null ? $editIndex : '' ?>">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= $editEtudiant ? htmlspecialchars($editEtudiant["nom"]) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $editEtudiant ? htmlspecialchars($editEtudiant["prenom"]) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="<?= $editEtudiant ? htmlspecialchars($editEtudiant["age"]) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="classe" class="form-label">Classe</label>
            <select name="classe" id="classe" class="form-select" required>
                <option value="ID" <?= $editEtudiant && $editEtudiant["classe"] == "ID" ? "selected" : "" ?>>ID</option>
                <option value="DEV" <?= $editEtudiant && $editEtudiant["classe"] == "DEV" ? "selected" : "" ?>>DEV</option>
                <option value="TRI" <?= $editEtudiant && $editEtudiant["classe"] == "TRI" ? "selected" : "" ?>>TRI</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary"><?= $editEtudiant ? "Modifier" : "Enregistrer" ?></button>
    </form>

    <h3 class="mt-5">Liste des Étudiants</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Classe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $index => $etudiant): ?>
                <tr>
                    <td><?php echo htmlspecialchars($etudiant["nom"]) ?></td>
                    <td><?= htmlspecialchars($etudiant["prenom"]) ?></td>
                    <td><?= htmlspecialchars($etudiant["age"]) ?></td>
                    <td><?= htmlspecialchars($etudiant["classe"]) ?></td>
                    <td>
                        <a href="?edit=<?php echo $index ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
