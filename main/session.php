<?php

session_start();

require_once 'model/sesion.php';

$sesion=new Sesion();





if(!isset($_SESSION["id_user"]) && !isset($_COOKIE['id_user'])){
    header('location: ../login/index.php'); 
}else{
 $result=$sesion->comprobarUsuario($_COOKIE['id_user']);
if($result->num_rows!=0){
  $_SESSION["id_user"]=$_COOKIE['id_user'];
  $_SESSION["permisos"]=$_COOKIE['permisos'];
}else{
  header('location: ../login/controller/cerrarSesion.php'); 
}
 
}





?>