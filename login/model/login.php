<?php

require_once '../config/Conexion.php';

Class login{


function comprobarLogin($user,$passwd){
    $query="SELECT count(id_usuario) AS id FROM usuarios WHERE usuario LIKE '$user' AND passwd LIKE '$passwd' AND estado LIKE '1'";
    return ejecutarConsultaSimpleFila($query);
}

function getId($user,$passwd){
    $query="SELECT id_usuario FROM usuarios WHERE usuario LIKE '$user' AND passwd LIKE '$passwd'";
    return ejecutarConsultaSimpleFila($query);
}


function getPermisos($id){
    $query="SELECT tipo_usuario FROM usuarios WHERE id_usuario LIKE '$id'";
    return ejecutarConsultaSimpleFila($query);
}




}

?>