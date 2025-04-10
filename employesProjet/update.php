<?php
$matricule = $_GET['matricule'] ?? null;
$data = json_decode(file_get_contents("employes.json"), true) ?? [];
$employe = null;

foreach ($data as $key => $emp) {
    if ($emp['matricule'] == $matricule) {
        $employe = $emp;
        $index = $key;
        break;
    }
}

if (!$employe) {
    echo "Employé non trouvé.";
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);

    if (!preg_match("/^[a-zA-Z\s]{3,}$/", $nom)) $errors[] = "Nom invalide.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
    if (!filter_var($linkedin, FILTER_VALIDATE_URL)) $errors[] = "URL LinkedIn invalide.";

    // Update image & CV if uploaded
    if ($_FILES['image']['name']) {
        if (!in_array($_FILES['image']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "Image invalide.";
        } else {
            $imagePath = 'uploads/images/' . uniqid() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            $employe['image'] = $imagePath;
        }
    }

    if ($_FILES['cv']['name']) {
        if (pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION) !== 'pdf') {
            $errors[] = "Le CV doit être un fichier PDF.";
        } else {
            $cvPath = 'uploads/cvs/' . uniqid() . '_' . basename($_FILES['cv']['name']);
            move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath);
            $employe['cv'] = $cvPath;
        }
    }

    if (empty($errors)) {
        $employe['nom'] = $nom;
        $employe['email'] = $email;
        $employe['linkedin'] = $linkedin;
        $data[$index] = $employe;
        file_put_contents("employes.json", json_encode($data, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">
    <h1>Modifier Employé</h1>
    <?php if ($errors): ?>
        <div class="alert alert-danger"><ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3"><label>Nom</label><input type="text" name="nom" value="<?= htmlspecialchars($employe['nom']) ?>" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" value="<?= $employe['email'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>LinkedIn</label><input type="url" name="linkedin" value="<?= $employe['linkedin'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>Nouvelle Image (optionnelle)</label><input type="file" name="image" accept="image/*" class="form-control"></div>
        <div class="mb-3"><label>Nouveau CV (PDF, optionnel)</label><input type="file" name="cv" accept=".pdf" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
