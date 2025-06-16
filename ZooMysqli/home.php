<?php
session_start();
include 'connexion.php';
include 'nav.php';

$id_user = $_SESSION['user']['id_user'];

// Total des visites
$sql1 = "SELECT COUNT(*) as total FROM visite v JOIN reservation r ON v.id_reservation = r.id_reservation WHERE r.id_user = $id_user";
$result1 = mysqli_query($conn, $sql1);
$res=mysqli_fetch_assoc($result1);
$total_visites = $res['total'];

// Nombre d'enclos visités
$sql2 = "SELECT COUNT(*) as total from enclos e join reservation r    on e.codeEnclos=r.idEnclos  WHERE r.id_user = $id_user";
$result2 = mysqli_query($conn, $sql2);
$res=mysqli_fetch_assoc($result2);
$nbr_enclos = $res['total'];

// Dates des visites
$sql3 = "SELECT date_visite FROM reservation WHERE id_user = $id_user ORDER BY date_visite DESC";
$result3 = mysqli_query($conn, $sql3);
?>

<h2>Informations générales</h2>
<p>Total des visites : <?= $total_visites ?></p>
<p>Nombre d'enclos visités : <?= $nbr_enclos ?></p>

<p>Dates des visites prévues :</p>
<ul>
    <?php while($row = mysqli_fetch_assoc($result3)) : ?>
        <li><?= $row['date_visite'] ?></li>
    <?php endwhile; ?>
</ul>
