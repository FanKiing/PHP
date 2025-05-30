<?php  
$message="";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $n=intval($_POST["cible"]);
    /*$fact=1;
    for($i=1;$i<=$m;$i++){
        $fact=$fact*$i
    }*/
    //autrement
    $l=array();
     $m=$n;
    while($m>0):
        array_push($l,$m);
        $m=$m-1;
    endwhile;

    $fact=array_reduce($l,fn($acc,$item)=>$acc*$item,1);
   $message="la factoriel de $n est $fact";

}







?>

<form action="" method="POST">

<label for="cible">Cible</label>
<input type="text" name="cible"><br>
<button type="submit">Calculer fact.</button>
<div style="color:green;"><?=$message?></div>


</form>