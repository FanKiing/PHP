<?php  
$listImg=[];
  if(isset($_COOKIE["photos"])){
   $listImg=json_decode($_COOKIE["photos"],true);
  }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container p-4 my-3 w-75">
   <div class="d-flex justify-content-end my-3"><a href="add.php" class="btn btn-sm btn-primary">Add New</a></div>
   <table class="table table-hover">
    <thead>
        <tr><th>Title</th><th>Category</th><th>Image</th><th>Actions</th></tr>
    </thead>
    <tbody>
          <?php  if(count($listImg)==0) :  ?>
                <tr><td colspan="4">Le tableau des images est vide !!!!!!</td></tr>
          <?php else:
                foreach($listImg as $index=>$img):?>
                  <tr><td><?= $img['title']?> </td><td><?= $img['category']?> </td>
                  <td><img src="<?= $img['image']?>" class="image-rounded" width="80" height="80"/> </td>
                  <td>
                    <a href="update.php?id=<?= $index ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="delete.php?id=<?= $index ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez vous vraiement supprimer ?');">Delete</a>
                  </td></tr>
                  


                  <?php endforeach; ?>
               
                  <?php endif;?>


          
    </tbody>


   </table>





</div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</body>
</html>