<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Display</title>
    <style>
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

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }

    .card {
        background-color: #2c2c2c; /* Dark card background */
        border: 2px solid #1abc9c; /* Teal border */
        border-radius: 10px;
        padding: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card img {
        width: 100%;
        aspect-ratio: 3/2;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    h1 {
        color: #1abc9c; /* Teal color */
        font-size: 24px;
    }

    h2 {
        color: #d4af37; /* Gold color */
        font-size: 20px;
    }

    p {
        color: #f4f4f4; /* Light text color */
        font-size: 16px;
    }

    a {
        color: #1abc9c; /* Teal color for links */
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    button, .action {
        background-color: #d4af37; /* Gold background */
        color: #1e1e1e; /* Dark text color */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        margin-inline: 5px;
        display: inline-block;
    }

    button:hover, .action:hover {
        background-color: #c0982d; /* Darker gold on hover */
    }

    .action {
        text-align: center;
        width: 100%;
        margin-top: 10px;
    }
</style>



</head>
<body>
<button onclick="window.location.href='employeeAdd.php'">Add Employee</button>

    <div class="container">
        <?php
        if (isset($_COOKIE['employees'])) {
            $employees = json_decode($_COOKIE['employees'], true);
        } else {
            echo 'Error: No employees data found.';
            exit;
        }

        foreach ($employees as $indx => $employee) {
            echo "<div class='card'>";

            echo "<img src='uploads/" . htmlspecialchars($employee["photo"]) . "' alt='" . htmlspecialchars($employee["photo"]) . "'>";
            echo "<h1>" . htmlspecialchars($employee["SN"]) . "</h1>";
            echo "<h2>" . htmlspecialchars($employee["name"]) . "</h2>";
            echo "<p>Email: " . htmlspecialchars($employee["email"]) . "</p>";
            echo "<p>LinkedIn: <a href='" . htmlspecialchars($employee["acc"]) . "'>" . htmlspecialchars($employee["acc"]) . "</a></p>";
            echo "<p>CV: <a href='" . htmlspecialchars($employee["cv"]) . "'>" . htmlspecialchars($employee["cv"]) . "</a></p>";
            echo "<button><a href='employeeDelete.php?index=" . $indx . " class='action'>Delete</a></button>";
            echo "<button><a href='employeeEdit.php?index=" . $indx . " class='action'>Edit</a></button>";

            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
