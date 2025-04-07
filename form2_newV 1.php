<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php
    if(isset($_COOKIE["products"])){
        $products=json_decode($_COOKIE["products"],true);

    }
    else{
        $products=[];
    }
 
    if(isset($_GET['pos'])){
        $indice=$_GET['pos'];
        $prodactToEdit=$products[$indice];
        
    }
    if(isset($_GET['del'])){
        $indice=$_GET['del'];
        array_splice($products,$indice,1);
        setcookie("products",json_encode($products),time()+86400);
        
          
        
    }

  if(isset($_POST['submit'])){
    if(isset($_POST["intitule"]) && !empty($_POST["intitule"])&&isset($_POST["prix"]) && !empty($_POST["prix"])&&isset($_POST["cat"]) && !empty($_POST["cat"])){
         $newProduct=["intitule"=>$_POST["intitule"],"prix"=>$_POST["prix"],"cat"=>$_POST["cat"]];
          if(isset($_POST["indice"])&& $_POST["indice"]!=''){
            $products[$_POST["indice"]]=$newProduct ;
          }else{
           
            array_push($products,$newProduct);
          }
     


         
          setcookie("products",json_encode($products),time()+86400);
          
          //utiliser localstorage pour storer les données
          //possiblité les cookies 
       
    }

  }



?>




</head>
<body>
      <div class="container w-75 mx-4 my-4 p-3">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <p><input type="hidden" name="indice" value="<?= isset($prodactToEdit)? $indice:'' ?>"  ></p>
                <p><label for="intitule">Intitule</label><input type="text" name="intitule" id="intitule" value="<?= isset($prodactToEdit)? $prodactToEdit['intitule']:'' ?>" class="form-control"/></p>
                <p><label for="prix">Prix</label><input type="number" step="0.001" name="prix"  value="<?= isset($prodactToEdit)? $prodactToEdit['prix']:'' ?>" id="prix" class="form-control"/></p>
                <p><label for="cat">Categorie</label>

                   <select name="cat" id="cat" class="form-select"  value="<?= isset($prodactToEdit)? $prodactToEdit['cat']:'' ?>">
                    <option value="" selected disabled>choisir une categorie...</option>
                    <option value="electromenager" <?php echo isset($prodactToEdit)&&$prodactToEdit['cat']=="electromenager"? "selected":"" ?>>electromenager</option>
                    <option value="alimentaire" <?php echo isset($prodactToEdit)&&$prodactToEdit['cat']=="alimentaire"? "selected":"" ?>>alimentaire</option>
                    <option value="plantes" <?php echo isset($prodactToEdit)&&$prodactToEdit['cat']=="plantes"? "selected":"" ?>>plantes</option>
                   </select>
                </p>
               
                <p><button type="submit" name="submit"  class="btn btn-info">Envoyer</button></p>


            </form>
            <table class="table table-hover">

            <thead><tr><th>Intitule</th><th>Prix</th><th>Categorie</th><th>Action</th></tr></thead>
            <tbody>
                <?php
                 if(empty($products)){
                    echo"<tr><td colspan='4'>No Data Found...</td></tr>";
                 }else{
                    for($i=0;$i<count($products);$i++){
                        echo "<tr><td>".$products[$i]["intitule"]."</td><td>".$products[$i]["prix"]."</td><td>".$products[$i]["cat"]."</td>";
                        echo "<td><a href='?pos=$i' class='btn btn-info'>Edit</a>";
                         echo "<a href='?del=$i' class='btn btn-danger' onclientclick='return confirm(\'voulez vous supprimer?\')'>delete</a></td></tr>";
                       

                    }


                 }


                    ?>
            </tbody>
            </table>

          <!-- cliquer sur submit ==> enregitrer les données du formulaire dans un associatif array predefini $_GET (method est GET)
              sous forme de key:value pairs =>key (name) et value (valeur de l'input)
              cet associatif array est accessible au niveau de page2.php-->
      </div>    


</body>
</html>