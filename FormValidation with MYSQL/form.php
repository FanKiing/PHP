<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Form with MySQL</title>
    <style>.error { color: red; }</style>
    <script>
        function showRangeValue(val) {
            document.getElementById("rangeValue").innerText = val;
        }
    </script>
</head>
<body>

<?php
$name = $email = $password = $gender = $age = "";
$hobbies = [];
$uploadMessage = $pdfMessage = "";

$nameErr = $emailErr = $passwordErr = $genderErr = $hobbiesErr = $fileErr = $pdfErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation
    if (empty($_POST["name"])) $nameErr = "Name is required.";
    else $name = htmlspecialchars($_POST["name"]);

    if (empty($_POST["email"])) $emailErr = "Email is required.";
    else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $emailErr = "Invalid email format.";
    }

    if (empty($_POST["password"])) $passwordErr = "Password is required.";
    else {
        $password = htmlspecialchars($_POST["password"]);
        if (strlen($password) < 6) $passwordErr = "Min 6 characters.";
    }

    if (empty($_POST["gender"])) $genderErr = "Gender is required.";
    else $gender = $_POST["gender"];

    if (empty($_POST["hobbies"])) $hobbiesErr = "Select at least one.";
    else $hobbies = $_POST["hobbies"];

    if (isset($_POST["age"])) $age = $_POST["age"];

    // File uploads
    $imageName = $pdfName = "";

    if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] == 0) {
        $imageName = basename($_FILES["profile"]["name"]);
        $imageDir = "uploads/";
        $imageFile = $imageDir . $imageName;
        $imageType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));
        if (in_array($imageType, ["jpg", "jpeg", "png", "gif"])) {
            if (!file_exists($imageDir)) mkdir($imageDir, 0777, true);
            move_uploaded_file($_FILES["profile"]["tmp_name"], $imageFile);
            $uploadMessage = "Image uploaded.";
        } else {
            $fileErr = "Only JPG, PNG, GIF allowed.";
        }
    } else {
        $fileErr = "Upload profile picture.";
    }

    if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] == 0) {
        $pdfName = basename($_FILES["cv"]["name"]);
        $pdfDir = "uploads/";
        $pdfFile = $pdfDir . $pdfName;
        if (strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION)) == "pdf") {
            move_uploaded_file($_FILES["cv"]["tmp_name"], $pdfFile);
            $pdfMessage = "PDF uploaded.";
        } else {
            $pdfErr = "Only PDF allowed.";
        }
    } else {
        $pdfErr = "Upload PDF file.";
    }

    // Insert into DB if no errors
    if (!$nameErr && !$emailErr && !$passwordErr && !$genderErr && !$hobbiesErr && !$fileErr && !$pdfErr) {
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $hobbiesStr = implode(",", $hobbies);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, gender, hobbies, age, image, pdf)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPass, $gender, $hobbiesStr, $age, $imageName, $pdfName]);
            echo "<h3>Form submitted and data saved to database!</h3>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>DB Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<h2>Register</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?= $name ?>">
    <span class="error">* <?= $nameErr ?></span><br><br>

    Email: <input type="text" name="email" value="<?= $email ?>">
    <span class="error">* <?= $emailErr ?></span><br><br>

    Password: <input type="password" name="password">
    <span class="error">* <?= $passwordErr ?></span><br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?= $gender == "Male" ? "checked" : "" ?>> Male
    <input type="radio" name="gender" value="Female" <?= $gender == "Female" ? "checked" : "" ?>> Female
    <span class="error">* <?= $genderErr ?></span><br><br>

    Hobbies:
    <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array("Reading", $hobbies) ? "checked" : "" ?>> Reading
    <input type="checkbox" name="hobbies[]" value="Sports" <?= in_array("Sports", $hobbies) ? "checked" : "" ?>> Sports
    <input type="checkbox" name="hobbies[]" value="Gaming" <?= in_array("Gaming", $hobbies) ? "checked" : "" ?>> Gaming
    <span class="error">* <?= $hobbiesErr ?></span><br><br>

    Age:
    <input type="range" name="age" min="10" max="100" value="<?= $age ?: 25 ?>" oninput="showRangeValue(this.value)">
    <span id="rangeValue"><?= $age ?: 25 ?></span><br><br>

    Profile Picture: <input type="file" name="profile">
    <span class="error">* <?= $fileErr ?></span><br><br>

    Upload CV (PDF): <input type="file" name="cv">
    <span class="error">* <?= $pdfErr ?></span><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
