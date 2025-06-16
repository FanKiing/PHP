<?php
session_start();
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $cin = $_POST['cin'];

    $sql = "SELECT * FROM user WHERE email='$email' AND cin='$cin' AND role='visiteur'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);//
        header("Location: home.php");
        exit();
    } else {
        $erreur = "Email ou CIN incorrect.";
    }
}
?>

<form method="post">
    Email: <input type="email" name="email" required><br>
    CIN: <input type="text" name="cin" required><br>
    <input type="submit" value="Se connecter">
</form>
<?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
