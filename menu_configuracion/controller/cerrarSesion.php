<?php 
require_once '../config/Conexion.php';
session_start();
$idUser=$_SESSION["id_user"];
$query="UPDATE `usuarios` SET `tokenAndroid`='' WHERE id_usuario LIKE '$idUser'";
ejecutarConsulta($query);
session_destroy();
if(isset($_COOKIE['id_user'])){
    setcookie("id_user", "", time() - 3600);
    unset($_COOKIE['id_user']); 
    setcookie('id_user', null, -1, '/'); 
}
header("Location: ../index.php");
die();

?>