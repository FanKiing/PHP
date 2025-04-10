<?php
$employees = [];
$errors = [];
$SN = $name = $email = $photo = $cv = $acc = '';
$SNEd = $nameEd = $emailEd = $accEd = '';
$uploadDirectory = 'uploads/';

if (isset($_COOKIE['employees'])) {
    $employees = json_decode($_COOKIE['employees'], true);
} else {
    setcookie('employees', json_encode($employees), time() + 86400 * 30, '/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['SN']) || intval(trim($_POST['SN'])) < 1000 || intval(trim($_POST['SN'])) >= 9999) {
        array_push($errors, 'Serial number must be an integer between 1000 and 9999');
    } else {
        $SN = intval(trim($_POST['SN']));
    }

    if (empty($_POST['name']) || !preg_match("/^[a-zA-ZÀ-ÿ\s]{3,}$/", $_POST['name'])) {
        array_push($errors, 'Name must be at least 3 characters long and contain only letters and spaces');
    } else {
        $name = trim($_POST['name']);
    }

    if (empty($_POST['email']) || !filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email');
    } else {
        $email = trim($_POST['email']);
    }

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $photo = basename($_FILES["photo"]["tmp_name"]);
        $photoPath = $uploadDirectory . $photo;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath)) {
            // File uploaded successfully
        } else {
            array_push($errors, "Failed to upload photo");
        }
    } else {
        $photo = $employees[$indexToEdit]["photo"];
    }

    if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] == 0) {
        $cv = basename($_FILES["cv"]["name"]);
        $cvPath = $uploadDirectory . $cv;
        if (move_uploaded_file($_FILES["cv"]["tmp_name"], $cvPath)) {
            // File uploaded successfully
        } else {
            array_push($errors, "Failed to upload CV");
        }
    } else {
        $cv = $employees[$indexToEdit]["cv"];
    }

    if (empty($_POST["acc"]) || !filter_var(trim($_POST["acc"]), FILTER_VALIDATE_URL)) {
        array_push($errors, "LinkedIn account is required");
    } else {
        $acc = trim($_POST["acc"]);
    }
    
    if (empty($errors)) {
        
        if (isset($_GET["index"])) {
            $indexToEdit = intval($_GET["index"]);
            if (isset($employees[$indexToEdit])) {
                $employees[$indexToEdit] = [
                    "SN" => $SN,
                    "name" => $name,
                    "email" => $email,
                    "photo" => $photo,
                    "cv" => $cv,
                    "acc" => $acc
                ];
                setcookie("employees", json_encode($employees), time() + 86400 * 30, "/");
                header("Location: employeeDisplay.php");
                exit;
            }
        }
    }
}
if (isset($_GET["index"])) {
    $indexToEdit = intval($_GET["index"]);
    if (isset($employees[$indexToEdit])) {
        $SNEd = $employees[$indexToEdit]["SN"];
        $nameEd = $employees[$indexToEdit]["name"];
        $emailEd = $employees[$indexToEdit]["email"];
        $accEd = $employees[$indexToEdit]["acc"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <style>
        button, .action-button {
        background-color: #d4af37; /* Gold background */
        color: #1e1e1e; /* Dark text color */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        display: inline-block;
    }
    button:hover, .action-button:hover {
        background-color: #c0982d; /* Darker gold on hover */
    }

    .action-button {
        text-align: center;
        width: 100%;
        margin-top: 10px;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #1e1e1e; /* Dark background */
        color: #f4f4f4; /* Light text color */
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    
      

    form {
        background-color: #2c2c2c; /* Dark form background */
        border: 2px solid #1abc9c; /* Teal border */
        border-radius: 10px;
        padding: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        margin: 20px auto;
    }

    label {
        color: #1abc9c; /* Teal color */
        font-size: 18px;
        margin-top: 10px;
    }

    input[type="number"],
    input[type="text"],
    input[type="email"],
    input[type="url"],
    input[type="file"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #1abc9c; /* Teal border */
        border-radius: 5px;
        background-color: #3a3a3a; /* Dark input background */
        color: #f4f4f4; /* Light text color */
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        border: none;
        border-radius: 5px;
        background-color: #d4af37; /* Gold background */
        color: #1e1e1e; /* Dark text color */
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #c0982d; /* Darker gold on hover */
    }

    .error {
        color: #ff6b6b; /* Red color for errors */
        font-size: 16px;
        margin-top: 10px;
    }
</style>

</head>
<body>
<button onclick="window.location.href='employeeDisplay.php'">View Employees</button>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="employeeEdit.php?index=<?php echo $indexToEdit; ?>" method="post" name="myForm" enctype="multipart/form-data">
        
        
        <label for="SN">Serial number</label>
        <input type="number" id="SN" name="SN" min="1000" max="9999" value="<?php echo htmlspecialchars($SNEd); ?>" readonly required>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($nameEd); ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($emailEd); ?>">

        <label for="photo">Photo</label>
        <input type="file" name="photo" accept="image/jpg,image/png,image/gif,image/jpeg" ">

        <label for="cv">CV</label>
        <input type="file" name="cv" accept="application/pdf" >

        <label for="acc">LinkedIn account</label>
        <input type="url" id="acc" name="acc" required value="<?php echo htmlspecialchars($accEd); ?>">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
