<?php  
  $v=["agadir","Fes","Rabat"];
  $p=["Maroc","Espagne","France"];
  $t=array_merge($v,$p);
  foreach($t as $e){
       echo $e."-";

  }
  echo "<br/>";

  for($i=0;$i<count($t);$i++){



echo $t[$i]."-";
  }










?>