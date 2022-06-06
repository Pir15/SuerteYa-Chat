<?php

session_start();





if(!isset($_SESSION["id_user"]) && !isset($_COOKIE['id_user'])){
    header('location: ../login/index.php'); 
}else{
  $_SESSION["id_user"]=$_COOKIE['id_user'];
}





?>