<?php  
$categories=["nature","animal","humain"];

$validExt=['png','jpeg','gif','jpg'];
$extension=$tempDir=$title=$category=$description="";
$listImg=$errors=[];
  if(isset($_COOKIE["photos"])){
   $listImg=json_decode($_COOKIE["photos"],true);
  }


  //le clic sur button:submit => initilise $_SERVER['REQUEST_METHOD']=method (POST/GET)
   if($_SERVER['REQUEST_METHOD']=="POST"){
          $title=htmlspecialchars(trim($_POST['title']));
          if(empty($title)){
             $errors[]="le titre est obligatoire !!!!";
          }elseif(strlen($title)<3){
             array_push($errors,"le titre doit avoir au minimum 3 caratéres !!!");
          }

          $category=htmlspecialchars(trim($_POST['category']));
          if(empty($category)){
             $errors[]="la categorie est obligatoire !!!!";
          }elseif(!in_array($category,$categories)){
             array_push($errors,"categorie invalide!!!");
          }
          $description=htmlspecialchars(trim($_POST['description']));
          if(empty($description)){
             $errors[]="la description est obligatoire !!!!";
          }elseif(strlen($description)<20){
             array_push($errors,"la description doit avoir au minimum 20 caratéres!!!");
          }
          if(!isset($_FILES["image"])){
             $errors[]="l'image est obligatoire !!!!";
          }elseif($_FILES['image']['error']!=0){
            $errors[]="erreur de chargement de l'image !!!!";
          
          }else{
             $tempDir=$_FILES["image"]['tmp_name'];
             $filName=$_FILES["image"]['name'];
             $size=$_FILES["image"]['size'];//en octets
             $extension=pathinfo($filName,PATHINFO_EXTENSION);
             if(!in_array($extension,$validExt) || $size>2000000){
                $errors[]="l'image choisi est invalide !!!!";
             }
             
          }
       
      //si tout va bien 
        if(empty($errors)){
             //storer l image dans le dossir storage 
             $newFileName="storage/".uniqid().".".$extension;
             move_uploaded_file($tempDir,$newFileName);
             $newImg=["title"=>$title,"category"=>$category,"description"=>$description,"image"=>$newFileName];
             $listImg[]=$newImg;
           
             //mise a jour le cookie $_COOKIE["photos"]
             setcookie("photos",json_encode($listImg),time()+3600);
              header('Location:index.php');

              exit;



        }




   }
  







?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container p-4 w-75 my-5">
    <?php  if(!empty($errors)):?>
           <div class="alert alert-danger">
                 <ul>
                    <?php foreach($errors as $error):?>
                      <li><?= $error;?></li>
                      <?php endforeach;?>
                 </ul>

           </div>
    <?php endif; ?>
         <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title"/>

            </div>
            <div class="mb-2">
                <label for="category">Category</label>
                <select name="category" id="" class="form-control">
                    <option value="">select category...</option>
                    <?php 
                      foreach($categories as $key=>$value):?>
                        <option value="<?= $value?>"><?= $value?></option>
                      <?php endforeach;?>
                </select>
            </div>
            <div class="mb-2">
                <label for="description">Description</label>
                <textarea  class="form-control" name="description"></textarea>
            </div>
            <div class="mb-2">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image"/>
            </div>
            <div class="mb-2">
                
                <button type="submit" class="btn btn-sm btn-info">Ajouter</button>
            </div>



         </form>



    </div>














    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>