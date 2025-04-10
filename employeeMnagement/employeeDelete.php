<?php

   $employees = json_decode($_COOKIE["employees"], true);
   if (isset($_GET["index"])) {
       $indexToDelete = intval($_GET["index"]);
       if (isset($employees[$indexToDelete])) {
           array_splice($employees, $indexToDelete, 1);
           setcookie("employees", json_encode($employees), time() + 86400 * 30, "/");
           header("Location: employeeDisplay.php");
           exit;
       }
   }
?>