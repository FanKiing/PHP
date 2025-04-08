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
