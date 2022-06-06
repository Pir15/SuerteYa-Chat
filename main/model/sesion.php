<?php

require_once 'config/Conexion.php';

Class Sesion{


function comprobarUsuario($id){
    $query="SELECT * FROM usuarios WHERE estado LIKE '1' AND `id_usuario` LIKE '$id';";
    return ejecutarConsulta($query);
}





}

?>