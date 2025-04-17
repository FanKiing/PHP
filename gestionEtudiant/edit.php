<?php
include 'db.php';
$num = $_GET['num'];
$result = mysqli_query($conn, "SELECT * FROM etudiants WHERE num = $num");
$etudiant = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $filiere = $_POST['filiere'];
    $siteweb = $_POST['siteweb'];
    $email = $_POST['email'];
    $genre = $_POST['genre'];
    $loisirs = implode(', ', $_POST['loisirs']);

    if ($_FILES['image']['name']) {
        $imagePath = "images/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = $etudiant['image'];
    }

    $query = "UPDATE etudiants SET 
              fullname='$fullname',
              image='$imagePath',
              filiere='$filiere',
              siteweb='$siteweb',
              email='$email',
              genre='$genre',
              loisirs='$loisirs'
              WHERE num=$num";

    mysqli_query($conn, $query);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
</head>
<body>
<h2>Modifier un étudiant</h2>
<form action="" method="POST" enctype="multipart/form-data">
    Nom complet : <input type="text" name="fullname" value="<?= $etudiant['fullname'] ?>"><br>
    Image : <input type="file" name="image"><br>
    Filière : <input type="text" name="filiere" value="<?= $etudiant['filiere'] ?>"><br>
    Site web : <input type="url" name="siteweb" value="<?= $etudiant['siteweb'] ?>"><br>
    Email : <input type="email" name="email" value="<?= $etudiant['email'] ?>"><br>
    Genre :
    <label><input type="radio" name="genre" value="Homme" <?= $etudiant['genre'] == 'Homme' ? 'checked' : '' ?>> Homme</label>
    <label><input type="radio" name="genre" value="Femme" <?= $etudiant['genre'] == 'Femme' ? 'checked' : '' ?>> Femme</label><br>
    Loisirs :
    <?php
   /* $loisirsArray = explode(', ', $etudiant['loisirs']);
    $options = ['sport', 'lecture', 'voyage'];
    foreach ($options as $opt) {
        $checked = in_array(strlower($opt), $loisirsArray) ? 'checked' : '';
        echo "<label><input type='checkbox' name='loisirs[]' value='$opt' $checked> $opt</label>";
    }*/
    ?><br><br>

      <!--autrement -->  
      <?php
    $loisirsArray = explode(', ', $etudiant['loisirs']);
   // die($etudiant['loisirs']);
    $options = ['sport', 'lecture', 'voyage'];
    //transformer les elet de $loisirsArray en minuscule
    $data=array_map(function($item){return strtolower($item);},$loisirsArray);
    //die(implode(', ',$data));
    foreach ($options as $opt) :
        $checked = in_array(strtolower($opt), $data) ? 'checked' : '';?>
     <label><input type="checkbox" name="loisirs[]" value="<?= $opt;?>" <?= $checked;?>> <?= $opt;?></label><br><br>
     <?php endforeach;?>






    <input type="submit" value="Modifier">
</form>
</body>
</html>
