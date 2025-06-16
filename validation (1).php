<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>
<body>
    <h1>Form Validation</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
 
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
 
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        <br><br>
 
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required>
        <br><br>
 
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
 
        <label for="country">Country:</label>
        <select id="country" name="country[]" multiple>
            <option value="morocco">Morocco</option>
            <option value="tunisie">Tunisie</option>
            <option value="algerie">Algerie</option>
        </select>
        <br><br>
 
        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label>
        <br><br>
 
        <label for="hobbies">Hobbies:</label><br>
        <input type="checkbox" id="reading" name="hobbies[]" value="reading">
        <label for="reading">Reading</label><br>
        <input type="checkbox" id="traveling" name="hobbies[]" value="traveling">
        <label for="traveling">Traveling</label><br>
        <input type="checkbox" id="sports" name="hobbies[]" value="sports">
        <label for="sports">Sports</label><br>
        <input type="checkbox" id="music" name="hobbies[]" value="music">
        <label for="music">Music</label><br>
        <br>
 
        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*">
        <br><br>
 
        <label for="cv">Upload CV (PDF only):</label>
        <input type="file" id="cv" name="cv" accept="application/pdf">
        <br><br>
 
        <button type="submit">Submit</button>
    </form>
</body>
</html>
<?php
// Validate form fields
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$password = isset($_POST["password"]) ? $_POST["password"] : '';
$age = isset($_POST["age"]) ? $_POST["age"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$country = isset($_POST["country"]) ? $_POST["country"] : [];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
$hobbies = isset($_POST["hobbies"]) ? $_POST["hobbies"] : [];
$birthdate = isset($_POST["birthdate"]) ? $_POST["birthdate"] : '';
 
$errors = [];
 
if (!empty($name) && !preg_match('/^[a-zA-Z]{2,}$/', $name)) {
    $errors[] = "votre nom est faux";
}
if (!empty($password) && !preg_match('/^.{5,}$/', $password)) {
    $errors[] = "invalid password";
}
if (!empty($birthdate)) {
    $timestamp = strtotime($birthdate);
    if (!$timestamp) {
        $errors[] = "Invalid birthdate format.";
    } elseif ($timestamp > time()) {
        $errors[] = "Birthdate cannot be in the future.";
    }
}
 
if (!empty($age) && !preg_match('/^\d{2,}$/', $age)) {
    $errors[] = "invalid age";
}
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "INVALID email";
}
if (!empty($country) && array_diff($country, ['morocco', 'tunisie', 'algerie'])) {
    $errors[] = "invalid country";
}
if (!empty($gender) && !in_array($gender, ['male', 'female'])) {
    $errors[] = "invalid gender";
}
if (!empty($hobbies) && array_diff($hobbies, ['reading', 'traveling', 'sports', 'music'])) {
    $errors[] = "invalid hobbies selected";
}
 
// Handle file uploads
$imageName = '';
$cvName = '';
 
// Image Upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($_FILES['image']['type'], $allowedTypes)) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imageName");
    } else {
        $errors[] = "Invalid image format. Allowed: jpg, png, gif";
    }
}
 
// CV Upload
if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    if ($_FILES['cv']['type'] === 'application/pdf') {
        $cvName = uniqid() . '_' . basename($_FILES['cv']['name']);
        move_uploaded_file($_FILES['cv']['tmp_name'], "uploads/$cvName");
    } else {
        $errors[] = "CV must be a PDF file";
    }
}
 
if ($errors) {
    echo implode('<br>', $errors);
    echo '<br><a href="validation.php">Back</a>';
    exit;
}
 
// Display submitted data
echo "<h1>Submitted Data</h1>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Password:</strong> $password</p>";
echo "<p><strong>Age:</strong> $age</p>";
echo "<p><strong>Birthdate:</strong> $birthdate</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Country:</strong>". implode(', ', $country)."</p>";
echo "<p><strong>Gender:</strong> $gender</p>";
echo "<p><strong>Hobbies:</strong> " . implode(', ', $hobbies) . "</p>";
 
if ($imageName) {
    echo "<p><strong>Uploaded Image:</strong> <a href='uploads/$imageName' target='_blank'>$imageName</a></p>";
}
 
if ($cvName) {
    echo "<p><strong>Uploaded CV:</strong> <a href='uploads/$cvName' target='_blank'>$cvName</a></p>";
}
 
exit;
?>
 