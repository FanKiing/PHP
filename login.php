<?php

include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=? and password=?");//mysqli->prepare
    mysqli_stmt_bind_param( $stmt,'ss',$email,$password);
    mysqli_stmt_execute($stmt);//stmt->execute
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'userType' => $user['userType']
        ];
        header("Location: index.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>


<?php if (isset($error)): ?>
    <p class="text-danger"><?= $error ?></p>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container w-75 p-4 m-4 mx-auto" >

    <h2>Connexion</h2>
<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" class="form-control" required><br><br>

    <label>Mot de passe:</label><br>
    <input type="password" name="password" class="form-control" required><br><br>

    <button type="submit">Se connecter</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

