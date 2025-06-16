<?php 

   /*$today=new DateTime();
   echo $today->format('Y-m-d H-i-s');*/ 


   $d=new DateTime('2025-02-23 13:15:20');

 echo  $d->format('Y-m-d H-i-s')."<br>";
 $d->modify('- 20 days');


 echo  $d->format('Y-m-d H-i-s')."<br>";





?>