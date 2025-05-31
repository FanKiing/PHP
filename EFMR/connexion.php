<?php 
include 'db2.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["password"];

    $username = trim($username);
    $password = trim($password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name" class="form-label">Nom d'utilisateur :</label>
    <input type="text" name="name" id="name" class="form-control" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" class="form-control" required>
    <br>
    <button type="submit">Se connecter</button>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
</form>