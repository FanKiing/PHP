
<?php 

$images=isset($_COOKIE['images'])?json_decode($_COOKIE['images'],true):[];







?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<a href="addEdit.php">Ajouter</a><br>
<table>
    <thead><tr><th>Title</th><th>category</th><th>Image</th><th>Action</th></tr></thead>
  <tbody>
  <?php if(empty($images)):?>
    <tr><td colspan="4">no data found !!!!</td></tr>
  <?php else:
    foreach($images as $image) :?>

    <tr><td><?php echo $image["title"]?></td><td><?php echo $image["category"]?></td>
    <td><img src ="<?php echo $image['chemin']?>" width="80px" height="80px"/></td>
    <td>Actions</td>
</tr>
<?php endforeach; endif;?>


  </tbody>



</table>
    
</body>
</html>