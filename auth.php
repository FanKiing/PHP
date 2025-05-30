<?php  
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
 $_SESSION["userName"]=$_POST["username"];
 $_SESSION["pwd"]=$_POST["pwd"];
  
header('Location:home.php');

}



//en general => session asso array qui les informations de l user connecté accessible dans toutes les pages 

//pour activer son utilisation : session_start 
//pour desactiver : session_end 
//pour supprimer toutes les sessions => session_destroy()
//pour supprier une variable donnée  : unset($_SESSION['cle'])


?>



<form action="" method="POST">

   <label for="username">UserName</label>
   <input type="text" name="username"/><br>

  <label for="pwd">Password</label>
   <input type="password" name="pwd"/><br>

<button type="submit">Envoyer </button>
</form>