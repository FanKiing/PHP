<?php  
   $list=['pomme','banane','fraise','cerise'];
   foreach($list as $index=>$elt):
    echo "$index : $elt <br/>" ;

   endforeach;
   echo "<br/><br/><br/>after unset<br/><br/><br/>";

   unset($list[1]);

   foreach($list as $index=>$elt):
    echo "$index : $elt<br/>" ;

   endforeach;
   echo "<br/><br/><br/>Reindexer le tableau using array values<br/><br/><br/>";
   $list=array_values($list);

 foreach($list as $index=>$elt):
    echo "$index : $elt<br/>" ;

   endforeach;
?>