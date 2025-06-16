<?php
session_start();
include 'connexion.php';
include 'nav.php';

$id_user = $_SESSION['user']['id_user'];

$sql = "SELECT v.id_visite, e.intitule, v.date_visite, v.etat
        FROM visite v
        JOIN reservation r ON v.id_reservation = r.id_reservation
        JOIN enclos e ON r.id_enclos = e.code_enclos
        WHERE r.id_user = $id_user
        ORDER BY v.date_visite DESC";

$result = mysqli_query($conn, $sql);
?>

<h2>Liste des visites</h2>
<table border="1">
    <tr>
        <th>Enclos</th>
        <th>Date</th>
        <th>État</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['intitule'] ?></td>
            <td><?= $row['date_visite'] ?></td>
            <td><?= $row['etat'] ?></td>
            <td><a href="modifier.php?id=<?= $row['id_visite'] ?>">Modifier</a></td>
        </tr>
    <?php endwhile; ?>
</table>
