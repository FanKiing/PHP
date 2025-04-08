<?php 
  $fileInfo="";
   if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_FILES["image"]) && $_FILES["image"]["error"]==0){

            $currentDir=$_FILES["image"]['tmp_name'];
            $name=$_FILES["image"]['name'];
            $taille=$_FILES["image"]['size'];
            $extension=pathinfo( $name,PATHINFO_EXTENSION);
            $validExrensions=['png','jpeg','jpg'];
            if(in_array(strtolower($extension),$validExrensions)){
                $newName=uniqid().'.'.$extension;
                $newDir='upload/'.$newName;
                move_uploaded_file($currentDir,$newDir);

                $fileInfo="<span style=\"color:'green';\">Bien sauvegardé !!!</span>";

            }
            else{
                $fileInfo="<span style=\"color:'red';\">Erreur de validation !!!</span>";
            }
       
    }






   }



?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data" method="POST">
    <input type="file" name="image" /><?= $fileInfo ?><br>
    <button type="submit">Upploader</button>
    </form>

</body>
</html>