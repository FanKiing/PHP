<!DOCTYPE html>
<html>
<head>
    <title>Extended Form Validation</title>
    <style>
        .error { color: red; }
    </style>
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
    // Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    // Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required.";
    } else {
        $password = htmlspecialchars($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters.";
        }
    }

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required.";
    } else {
        $gender = $_POST["gender"];
    }

    // Hobbies
    if (empty($_POST["hobbies"])) {
        $hobbiesErr = "Please select at least one hobby.";
    } else {
        $hobbies = $_POST["hobbies"];
    }

    // Age
    if (isset($_POST["age"])) {
        $age = $_POST["age"];
    }

    // Image file upload
    if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] == 0) {
        $imageName = basename($_FILES["profile"]["name"]);
        $imageDir = "uploads/";
        $imageFile = $imageDir . $imageName;

        $imageType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));
        $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageType, $allowedImageTypes)) {
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }
            move_uploaded_file($_FILES["profile"]["tmp_name"], $imageFile);
            $uploadMessage = "Image uploaded: $imageName";
        } else {
            $fileErr = "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $fileErr = "Please upload a profile picture.";
    }

    // PDF file upload
    if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] == 0) {
        $pdfName = basename($_FILES["cv"]["name"]);
        $pdfDir = "uploads/";
        $pdfFile = $pdfDir . $pdfName;

        $pdfType = strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION));

        if ($pdfType === "pdf") {
            move_uploaded_file($_FILES["cv"]["tmp_name"], $pdfFile);
            $pdfMessage = "PDF uploaded: $pdfName";
        } else {
            $pdfErr = "Only PDF files are allowed.";
        }
    } else {
        $pdfErr = "Please upload a PDF file.";
    }
}
?>

<h2>Extended Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span><br><br>

    Email: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span><br><br>

    Password: <input type="password" name="password">
    <span class="error">* <?php echo $passwordErr; ?></span><br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female
    <span class="error">* <?php echo $genderErr; ?></span><br><br>

    Hobbies:
    <input type="checkbox" name="hobbies[]" value="Reading" <?php if (in_array("Reading", $hobbies)) echo "checked"; ?>> Reading
    <input type="checkbox" name="hobbies[]" value="Sports" <?php if (in_array("Sports", $hobbies)) echo "checked"; ?>> Sports
    <input type="checkbox" name="hobbies[]" value="Gaming" <?php if (in_array("Gaming", $hobbies)) echo "checked"; ?>> Gaming
    <span class="error">* <?php echo $hobbiesErr; ?></span><br><br>

    Age:
    <input type="range" name="age" min="10" max="100" value="<?php echo $age ?: 25; ?>" oninput="showRangeValue(this.value)">
    <span id="rangeValue"><?php echo $age ?: 25; ?></span><br><br>

    Profile Picture (JPG, PNG, GIF): <input type="file" name="profile">
    <span class="error">* <?php echo $fileErr; ?></span><br><br>

    Upload CV (PDF): <input type="file" name="cv">
    <span class="error">* <?php echo $pdfErr; ?></span><br><br>

    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    !$nameErr && !$emailErr && !$passwordErr && !$genderErr && !$hobbiesErr && !$fileErr && !$pdfErr) {
    echo "<h3>Form submitted successfully!</h3>";
    echo "Name: $name<br>Email: $email<br>Password: (hidden)<br>Gender: $gender<br>";
    echo "Hobbies: " . implode(", ", $hobbies) . "<br>";
    echo "Age: $age<br>";
    echo $uploadMessage . "<br>" . $pdfMessage;
}
?>

</body>
</html>
