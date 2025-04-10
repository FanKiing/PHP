<?php
$matricule = $_GET['matricule'] ?? null;
$data = json_decode(file_get_contents("employes.json"), true) ?? [];

foreach ($data as $i => $emp) {
    if ($emp['matricule'] == $matricule) {
        unset($data[$i]);
        file_put_contents("employes.json", json_encode(array_values($data), JSON_PRETTY_PRINT));
        break;
    }
}
header("Location: index.php");
exit;
?>
