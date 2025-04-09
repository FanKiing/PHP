<?php

$listImg=[];
  if(isset($_COOKIE["photos"])){
   $listImg=json_decode($_COOKIE["photos"],true);
  }
  if(!isset( $_GET["id"]) || empty($listImg)){
    header('Location:index.php');
    exit;
}

$pos=$_GET["id"];
unset($listImg[$pos]);
//array_splice($listImg,$pos,1)
setcookie("photos",json_encode($listImg),time()+3600);

header('Location:index.php');
exit;
   


  ?>