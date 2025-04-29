<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("INSERT INTO todos (title, description, category_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $desc, $category_id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Todo</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php
                $result = mysqli_query($conn,"SELECT * FROM categories");
                $cats = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($cats as $cat) {
                    echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
