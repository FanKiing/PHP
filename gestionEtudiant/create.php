<?php
include 'db.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname=trim($_POST['fullname']);
    $filiere=trim($_POST['filiere']);
    $siteweb=trim($_POST['siteweb']);
    $email=trim($_POST['email']);
    $genre=$_POST['genre'] ?? '';//  $genre=isset($_POST['genre'])?$_POST['genre']:'';
    $loisirs = isset($_POST['loisirs']) ? implode(', ', $_POST['loisirs']) : '';
// la validation des données saisies 
    if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        $errors[] = "Nom complet invalide. Lettres uniquement.";
       // array_push($errors,"Nom complet invalide. Lettres uniquement.");
    }
  
    if (!preg_match("/^[\w\s]+$/", $filiere)) {
        $errors[] = "Filière invalide.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }

    if (!filter_var($siteweb, FILTER_VALIDATE_URL)) {
        $errors[] = "Site web invalide.";
    }

    if (!in_array(strtolower($genre), ['homme', 'femme'])) {
        $errors[] = "Genre invalide.";
    }

    if (empty($errors)) { //if(count($errors)==0)
        // Image
        $imagePath = "images/" .uniqid()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

        $query = "INSERT INTO etudiants (fullname, image, filiere, siteweb, email, genre, loisirs)
                  VALUES ('$fullname', '$imagePath', '$filiere', '$siteweb', '$email', '$genre', '$loisirs')";

        mysqli_query($conn, $query);

        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un nouvel étudiant</title>
</head>
<body>
<h2>Ajouter un nouvel étudiant</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
    Nom complet : <input type="text" name="fullname" required><br>
    Image : <input type="file" name="image" required><br>
    Filière : <input type="text" name="filiere"><br>
    Site web : <input type="text" name="siteweb"><br>
    Email : <input type="text" name="email"><br>
    Genre :
    <label><input type="radio" name="genre" value="Homme" required> Homme</label>
    <label><input type="radio" name="genre" value="Femme"> Femme</label><br>
    Loisirs :
    <label><input type="checkbox" name="loisirs[]" value="Sport"> Sport</label>
    <label><input type="checkbox" name="loisirs[]" value="Lecture"> Lecture</label>
    <label><input type="checkbox" name="loisirs[]" value="Voyage"> Voyage</label><br><br>
    <input type="submit" value="Ajouter">
</form>
</body>
</html>

