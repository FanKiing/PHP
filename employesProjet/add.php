<?php
function is_valid_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_valid_name($name) {
    return preg_match("/^[a-zA-Z\s]{3,}$/", $name);
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricule = intval($_POST['matricule']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);
    $image = $_FILES['image'];
    $cv = $_FILES['cv'];

    // Validation
    if ($matricule < 1000 || $matricule > 5000) $errors[] = "Matricule entre 1000 et 5000.";
    if (!is_valid_name($nom)) $errors[] = "Nom invalide.";
    if (!is_valid_email($email)) $errors[] = "Email invalide.";
    if (!is_valid_url($linkedin)) $errors[] = "URL LinkedIn invalide.";

    if (!in_array($image['type'], ['image/jpeg', 'image/png'])) $errors[] = "Image invalide.";
    if (pathinfo($cv['name'], PATHINFO_EXTENSION) !== 'pdf') $errors[] = "Le CV doit être un fichier PDF.";

    $data = json_decode(file_get_contents("employes.json"), true) ?? [];
    foreach ($data as $emp) {
        if ($emp['matricule'] == $matricule) {
            $errors[] = "Matricule déjà utilisé.";
            break;
        }
    }

    if (empty($errors)) {
        // Uploads
        $imgPath = 'uploads/images/' . uniqid() . '_' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imgPath);

        $cvPath = 'uploads/cvs/' . uniqid() . '_' . basename($cv['name']);
        move_uploaded_file($cv['tmp_name'], $cvPath);

        $data[] = [
            'matricule' => $matricule,
            'nom' => $nom,
            'email' => $email,
            'linkedin' => $linkedin,
            'image' => $imgPath,
            'cv' => $cvPath
        ];

        file_put_contents("employes.json", json_encode($data, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">
    <h1>Ajouter un Employé</h1>
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul>
        </div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3"><label>Matricule</label><input type="number" name="matricule" class="form-control" required></div>
        <div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label>LinkedIn</label><input type="url" name="linkedin" class="form-control" required></div>
        <div class="mb-3"><label>Image</label><input type="file" name="image" accept="image/*" class="form-control" required></div>
        <div class="mb-3"><label>CV (PDF)</label><input type="file" name="cv" accept=".pdf" class="form-control" required></div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
