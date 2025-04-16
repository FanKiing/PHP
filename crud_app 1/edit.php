<?php
include 'db.php';
include 'functions.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    if (!empty($_FILES['image']['name'])) {
        $imagePath = uploadImage($_FILES['image']);
    } else {
        $imagePath = $user['image'];
    }

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', image='$imagePath' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Modifier l'utilisateur</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Image actuelle :</label><br>
            <img src="<?= $user['image']; ?>" width="100"><br><br>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
</body>
</html>
