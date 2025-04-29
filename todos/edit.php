<?php
include 'db.php';

$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM todos WHERE id = $id");
$todo=mysqli_fetch_assoc($result);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("UPDATE todos SET title=?, description=?, category_id=? WHERE id=?");
    $stmt->bind_param("ssii", $title, $desc, $category_id, $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier le Todo</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" value="<?= $todo['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?= $todo['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <select name="category_id" class="form-select">
                <?php
                $result = mysqli_query($conn,"SELECT * FROM categories");
                $cats=mysqli_fetch_all($result,MYSQLI_ASSOC);
                foreach ($cats  as $cat) {
                    $selected = $cat['id'] == $todo['category_id'] ? 'selected' : '';
                    echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
