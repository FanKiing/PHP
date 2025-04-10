<?php
session_start();
$errors=[];
$nom=$email="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $nom=htmlspecialchars(trim($_POST['nom']));
         $email=htmlspecialchars(trim($_POST['email']));
         //validation du nom
        if(empty($nom)){
            $errors['errorNom']="le nom est obligatoire !!!";
        }
        else{
            if(!preg_match("/^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/",$nom)){
                $errors['errorNom']="le nom est invalide !!!!";
            }
        }
        //validation de l'email
        if(empty($email)){
            $errors['errorEmail']="l'email est obligatoire !!!";
        }
        else{
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['errorEmail']="l email est invalide !!!!";
            }
        }

     if(empty($errors)){

            $user = [
                'nom' => $nom,
                'email' => $email
            ];
            $_SESSION['users'][] = $user;//array_push($_SESSION['users'],$user)
            header("Location: index.php");
           }
        }
         ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Ajouter un utilisateur</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?=$nom??''?>"> <span class="text-danger"><?= $errors['errorNom']??""?></span>
           <input type="text" name="nom" class="form-control" value="<?=$nom??''?>" > <span class="text-danger"><?php if(isset($errors['errorNom'])):echo  $errors['errorNom']; else : echo ""; endif; ?></span>
            <input type="text" name="nom" class="form-control" value="<?=$nom??''?> "> <span class="text-danger"><?= isset($errors['errorNom'])?$errors['errorNom']: ""; ?></span>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="<?=$email??''?> "><span class="text-danger"><?= $errors['errorEmail']??""?></span>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
