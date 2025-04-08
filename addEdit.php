<?php 
 $title=$description=$category=$filename=$tempDir=$extensionFile="";
  $categories=['nature','animal','humain'];
  $errors=[];
   $images=isset($_COOKIE['images'])?json_decode($_COOKIE['images'],true):[];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    if(empty($_POST['title'])){
        $errors['errorTitle']='le titre est obligatoire !!!';

    }
    else{
       
            $title=htmlspecialchars(trim($_POST['title']));
        
       if(strlen(htmlspecialchars(trim($_POST['title'])))<5){
        $errors['errorTitle']='le titre doit contenir au moins 5 chars !!!';
       }
    

    }

    if(empty($_POST['category'])){
        $errors['category']='la categorie est obligatoire !!!';

    }
    else{
        $category=$_POST['category'];
         if(in_array(strtolower($_POST['category']),$categories)==false){
            $errors['category']='la categorie est invalide !!!';
         }
      
    }
    if(isset($_POST['image'])){
        $errors['image']="l'image  est obligatoire !!!";

    }
    else{
          $extension=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
          if(!in_array(strtolower($extension),['jpeg','jpg','png'])){
            $errors['image']="votre image est invalide !!!!!";
          }else{
          $filename=$_FILES['image']['name'];
          $tempDir=$_FILES['image']['tmp_name'];
          $extensionFile=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
          }




    }

    //verifier si tout va bien 

    if(empty($errors)){

        $path='images/'.uniqid().".".$extensionFile;
       move_uploaded_file($tempDir,$path);
       $newImage=["title"=>$title,"category"=>$category,"description"=>$description,"chemin"=>$path];
       array_push($images,$newImage);
      
       setcookie("images",json_encode($images),time()+686523);
       header('Location:index.php');
    
     


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
    <form action="<?= $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
         <p> <label for="title">Title</label>
<input type="text" value="<?php echo $title ?>" name="title"/><span><?php echo  $errors['errorTitle']??""; ?> </span></p>

<p> <label for="category">Category</label>
          <select name="category" id="">
            <?php  foreach($categories as $cat) : ?>
            <option value="<?= $cat ?>" <?php echo $cat==$category?"selected":"" ?>><?= $cat?></option>
            <?php endforeach ?>

          </select><span><?php echo  $errors['category']??""; ?></span></p>
<p>
<label for="description">description</label>
<textarea name="description" value="<?= $description ?>" id="">

</textarea><span></span>

</p>
<p>
<label for="image">Image</label>
<input type="file" name="image"/><span><?php echo  $errors['image']??""; ?></span>
</p>
<p>
    <button type="submit"> Envoyer </button>
</p>
      </form>
    
</body>
</html>