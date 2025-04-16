<?php
require 'db.php';
require 'navbar.php';

$errors = [];
$filieres = ['Informatique', 'Mathématiques', 'Physique', 'Biologie'];  // Exemple de filières

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validation du CEF
    $cef = $_POST['cef'];
    if (empty($cef) || !is_numeric($cef)) {
        $errors[] = "Le CEF est obligatoire et doit être un nombre.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE cef = ?");
        $stmt->execute([$cef]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "Le CEF existe déjà.";
        }
    }

    // Validation du nom complet
    $fullName = $_POST['fullName'];
    if (empty($fullName) || !preg_match("/^[A-Z][A-Za-z']{2,}(\s[A-Za-z']+)*$/", $fullName)) {
        $errors[] = "Le nom complet est obligatoire et doit correspondre au format valide.";
    }

    // Validation de la filière
    $filiere = $_POST['filiere'];
    if (empty($filiere)) {
        $errors[] = "La filière est obligatoire.";
    }

    // Validation du genre
    $genre = $_POST['genre'];
    if (empty($genre)) {
        $errors[] = "Le genre est obligatoire.";
    }

    // Validation des loisirs
    $loisirs = isset($_POST['loisirs']) ? $_POST['loisirs'] : [];
    if (count($loisirs) < 2) {
        $errors[] = "Vous devez choisir au moins deux loisirs.";
    }

    // Validation de l'image
    $image = $_FILES['image'];
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if (!in_array($imageExtension, $allowedExtensions)) {
            $errors[] = "L'image doit être au format PNG, JPG ou JPEG.";
        } else {
            $imageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($image['tmp_name'], 'uploads/' . $imageName);
        }
    } else {
        $errors[] = "Une erreur est survenue lors de l'upload de l'image.";
    }

    // Si aucune erreur, insertion en base de données
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO etudiants (cef, fullName, email, github, filiere, image, genre, loisirs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cef, $fullName, $_POST['email'], $_POST['github'], $filiere, $imageName, $genre, implode(',', $loisirs)]);
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Ajouter un étudiant</h2>

<?php
if (!empty($errors)) {
    echo '<ul style="color: red;">';
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo '</ul>';
}
?>

<form method="POST" enctype="multipart/form-data">
    <label for="cef">CEF:</label>
    <input type="text" id="cef" name="cef" value="<?= isset($cef) ? $cef : '' ?>" required><br><br>

    <label for="fullName">Nom complet:</label>
    <input type="text" id="fullName" name="fullName" value="<?= isset($fullName) ? $fullName : '' ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"><br><br>

    <label for="github">Lien GitHub:</label>
    <input type="url" id="github" name="github" value="<?= isset($_POST['github']) ? $_POST['github'] : '' ?>"><br><br>

    <label for="filiere">Filière:</label>
    <select id="filiere" name="filiere" required>
        <option value="">Sélectionner une filière</option>
        <?php foreach ($filieres as $f) : ?>
            <option value="<?= $f ?>" <?= isset($filiere) && $filiere == $f ? 'selected' : '' ?>><?= $f ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg" required><br><br>

    <label>Genre:</label>
    <input type="radio" name="genre" value="Homme" <?= isset($genre) && $genre == 'Homme' ? 'checked' : '' ?>> Homme
    <input type="radio" name="genre" value="Femme" <?= isset($genre) && $genre == 'Femme' ? 'checked' : '' ?>> Femme<br><br>

    <label>Loisirs:</label><br>
    <input type="checkbox" name="loisirs[]" value="Lecture" <?= isset($loisirs) && in_array('Lecture', $loisirs) ? 'checked' : '' ?>> Lecture<br>
    <input type="checkbox" name="loisirs[]" value="Sport" <?= isset($loisirs) && in_array('Sport', $loisirs) ? 'checked' : '' ?>> Sport<br>
    <input type="checkbox" name="loisirs[]" value="Musique" <?= isset($loisirs) && in_array('Musique', $loisirs) ? 'checked' : '' ?>> Musique<br><br>

    <button type="submit">Ajouter l'étudiant</button>
</form>
