<?php

require_once '../config/Conexion.php';

Class Contactos{


function getGrupos(){
    $query="SELECT tipo_usuario, count(tipo_usuario) FROM usuarios WHERE count(tipo_usuario)>0 GROUP BY tipo_usuario";
    return ejecutarConsulta($query);
}

function getGruposWhitoutMe($id){
    $query="SELECT tipo_usuario, count(tipo_usuario) AS numero FROM usuarios WHERE id_usuario NOT LIKE '$id' GROUP BY tipo_usuario";
    return ejecutarConsulta($query);
}

function getUsers(){
    $query="SELECT * FROM usuarios";
    return ejecutarConsulta($query);
}

function getUsersWhitoutMe($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' ORDER BY tipo_usuario,usuario";
    return ejecutarConsulta($query);
}

function getUsersWhitoutMeAndWhitoutProfessionals($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND tipo_usuario < 100 ORDER BY tipo_usuario,usuario";
    return ejecutarConsulta($query);
}

function getUsersbyType($type){
    $query="SELECT * FROM usuarios WHERE tipo_usuario LIKE '$type' ORDER BY usuario";
    return ejecutarConsulta($query);
}

function getUsersbyTypeWhitoutMe($type,$id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND  tipo_usuario LIKE '$type' ORDER BY usuario";
    return ejecutarConsulta($query);
    
}

function newGroup($nombre,$idUsuarios,$admin){
    $query="INSERT INTO `chat`(`tipo_chat`, `Nombre`, `id_usuarios`,`id_admin`) VALUES ('GRUPO','$nombre','$idUsuarios','$admin')";
    return ejecutarConsulta_retornarID($query);
}

function newChat($idUsuarios){
    $query="INSERT INTO `chat`(`tipo_chat`, `id_usuarios`) VALUES ('INDIVIDUAL','$idUsuarios')";
    return ejecutarConsulta_retornarID($query);
}

function buscarChat($idUser,$myId){
    
    $query="SELECT * FROM `chat` WHERE (
        (id_usuarios LIKE '%,$idUser,%' AND id_usuarios LIKE '%,$myId,%') 
        OR (id_usuarios LIKE '$idUser,%' AND id_usuarios LIKE '$myId,%')
        OR (id_usuarios LIKE '%,$idUser,%' AND id_usuarios LIKE '$myId,%')
        OR (id_usuarios LIKE '$idUser,%' AND id_usuarios LIKE '%,$myId,%')
        ) AND tipo_chat LIKE 'INDIVIDUAL'";
    return ejecutarConsultaSimpleFila($query);
    //return $query;


}


}

?>