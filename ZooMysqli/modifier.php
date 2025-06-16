<?php
session_start();
include 'connexion.php';
include 'nav.php';

$id_visite = $_GET['id'];

// Récupérer les données de la visite
$sql = "SELECT v.*, r.date_visite as date_reservation
        FROM visite v
        JOIN reservation r ON v.id_reservation = r.id_reservation
        WHERE v.id_visite = $id_visite";

$result = mysqli_query($conn, $sql);
$visite = mysqli_fetch_assoc($result);

// Suggestion d’état
$date_auj = date('Y-m-d');
$etat_suggere = $visite['etat'];

if ($visite['date_reservation'] == $date_auj) {
    $etat_suggere = 'réalisé';
} elseif ($visite['date_reservation'] < $date_auj) {
    $etat_suggere = 'annulée';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etat = $_POST['etat'];
    $update = "UPDATE visite SET etat='$etat' WHERE id_visite=$id_visite";
    mysqli_query($conn, $update);
    header("Location: listeVisite.php");
    exit();
}
?>

<h2>Modifier une visite</h2>
<form method="post">
    Date prévue : <?= $visite['date_reservation'] ?><br>
    État :
    <select name="etat">
        <option value="prévu" <?= $etat_suggere == 'prévu' ? 'selected' : '' ?>>Prévu</option>
        <option value="réalisé" <?= $etat_suggere == 'réalisé' ? 'selected' : '' ?>>Réalisé</option>
        <option value="annulée" <?= $etat_suggere == 'annulée' ? 'selected' : '' ?>>Annulée</option>
    </select><br><br>
    <input type="submit" value="Mettre à jour">
</form>
