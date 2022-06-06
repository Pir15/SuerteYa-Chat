<?php

require_once '../config/Conexion.php';

$query="UPDATE `usuarios` SET `tokenAndroid`='1' WHERE id_usuario LIKE '1'";
    echo $query;
    
Class Token{
    
function setToken($idUser,$token){
    
    //return ejecutarConsulta($query);
    //return $query;

}


}

?>