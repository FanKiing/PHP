<?php
include "db.php";
$sql = "SELECT * FROM PRODUCTS";
$data=mysqli_query($conn,$sql);
// die(mysqli_fetch_assoc($data));
$res=mysqli_fetch_all($data,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>CoIde</th>
                <th>Designation</th>
                <th>Prix Unitaire</th>
                <th>stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($res as $row):?>
                <tr>
                    <td><?= $row['Codep'];?></td>
                    <td><?= $row["Designation"];?></td>
                    <td><?= $row["Prix_unitaire"];?></td>
                    <td><?= $row["Stock"];?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</body>
</html>