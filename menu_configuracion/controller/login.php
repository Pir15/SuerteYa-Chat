<?php 

session_start();
require_once '../model/login.php';

$login=new Login();


if(isset($_POST["user"]) && isset($_POST["passwd"])){

$user=$_POST["user"];
$passwd=$_POST["passwd"];

$result=$login->comprobarLogin($user,$passwd);
if($result["id"]!=0){
    $result=$login->getId($user,$passwd);
    $id=$result["id_usuario"];
    $_SESSION["id_user"]=$id;

    $result=$login->getPermisos($id);
    $per=$result["tipo_usuario"];
    $_SESSION["permisos"]=$per;


    if(!isset($_COOKIE["id_user"])) {
        setcookie("id_user", $id, time() + (86400 * 365), "/");
        setcookie("permisos", $per, time() + (86400 * 365), "/");
    }
    echo "OK";
}else{
    echo "0";
}

}else{
    echo "0";
}


?>