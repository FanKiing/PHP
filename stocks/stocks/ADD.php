<?php
    include "db.php";
    
    $desg=isset($_POST["dsgn"]) ? $_POST["dsgn"] : "";
    $prix=isset($_POST["price"]) ? $_POST["price"] : "";
    $stock=isset($_POST["stkp"]) ? $_POST["stkp"] : "";
    $errors=[];

    if(empty($desg) || !preg_match('/^.{3,}/',$desg)){
        $errors[]="designation error";
    }
    if(empty($prix) || !preg_match('/^[0-9]{3,}/',$prix)){
        $errors[]="error in numberr";
    }
    if(empty($stock) || !preg_match('/^[0-9]{3,}/',$prix)){
        $errors[]="error in stock";
    }

    if(!empty($errors)){
        echo implode('<br>',$errors);   
    }else{
        // $sql= "INSERT INTO products(Designation,Prix_unitaire,Stock)VALUES('$desg','$prix','$stock')";
        $sql = "INSERT INTO products (Designation, Prix_unitaire, Stock) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        // Liaison des paramètres : s = string, d = double, i = integer
        mysqli_stmt_bind_param($stmt, "sdi", $designation, $prix, $stock);
        
        // Exécution de la requête
        if (mysqli_stmt_execute($stmt)) {
            echo "Produit inséré avec succès.";
        } else {
            echo "Erreur : " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

    header('Location: lister.php');
    exit;
?>