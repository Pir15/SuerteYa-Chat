<?php

session_start();
require_once '../config/Conexion.php';
$idUser=$_SESSION["id_user"];
$token=$_POST["to"];
$query="UPDATE `usuarios` SET `tokenAndroid`='$token' WHERE id_usuario LIKE '$idUser'";
ejecutarConsulta($query);
echo $query;

  




?>