<?php  
  $myArr=['html','css','bootstrap'];
  //transformer en chaine de caractére =>  join
  print_r($myArr);
  echo "<br/>";
  $myStr=implode('*',$myArr);
  echo $myStr."<br>";

  $v2=explode("*",$myStr); //split
  print_r($v2);








?>