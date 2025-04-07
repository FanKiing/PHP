<?php


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Consolas', sans-serif;
            background-color: #ddd;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

    </style>
</head>
<body>
    <div class="container mb-4">
        <form action="">
            <div class="form-group">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" name="name" id="name" class="form-control">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="confirmpassword" class="form-label">Confirmer le mot de passe :</label>
                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="site" class="form-label">Site Web (facultatif) :</label>
                <input type="text" name="site" id="site" class="form-control">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="gender" class="form-label">Gender :</label>
                <input type="radio" name="male" id="male" value="male">Homme
                <input type="radio" name="female" id="female" value="female">Femme
                <span class="error"></span>
            </div>
            <button class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</body>
</html>