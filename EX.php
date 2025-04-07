<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mb-4">
        <h2>Formulaire d'inscription</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="myForm">
            <div class="form-group">
                <label for="lname" class="form-label">Nom</label>
                <input type="text" name="lname" id="lname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fname" class="form-label">Prénom</label>
                <input type="text" name="fname" id="fname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" id="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="class" class="form-label">Classe</label>
                <select name="class" id="class" class="form-control" required>
                    <option value="" disabled>Choisir votre classe</option>
                    <option value="primary">Primary</option>
                    <option value="highSchool">High School</option>
                    <option value="university">University</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
<?php

$etudiants = [];

if (isset($_COOKIE["etudiants"])) {
    $etudiants = json_decode($_COOKIE["etudiants"], true);
}

if (isset($_POST["lname"]) && !empty($_POST["lname"]) && isset($_POST["fname"]) && !empty($_POST["fname"]) && isset($_POST["age"]) && !empty($_POST["age"]) && isset($_POST["class"]) && !empty($_POST["class"])) {
    $newEtudiant = [
        "nom" => $_POST["lname"],
        "prenom" => $_POST["fname"],
        "age" => $_POST["age"],
        "classe" => $_POST["class"]
    ];

    array_push($etudiants, $newEtudiant);

    setcookie("etudiants", json_encode($etudiants), time() + 86400);
}

?>
    <table class="table table-hover">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Age</th>
            <th>Classe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant) { ?>
            <tr>
                <td><?= $etudiant["nom"] ?></td>
                <td><?= $etudiant["prenom"] ?></td>
                <td><?= $etudiant["age"] ?></td>
                <td><?= $etudiant["classe"] ?></td>
                <td>
                    <a href="#" class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>

    </div>
</body>
</html>