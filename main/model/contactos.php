<?php

require_once '../config/Conexion.php';

Class Contactos{


function getGrupos(){
    $query="SELECT tipo_usuario, count(tipo_usuario) FROM usuarios WHERE count(tipo_usuario)>0 GROUP BY tipo_usuario";
    return ejecutarConsulta($query);
}

function getGruposWhitoutMe($id){
    $query="SELECT tipo_usuario, count(tipo_usuario) AS numero FROM usuarios WHERE id_usuario NOT LIKE '$id' GROUP BY tipo_usuario,nombre";
    return ejecutarConsulta($query);
}

function getUsers(){
    $query="SELECT * FROM usuarios WHERE estado LIKE '1' ORDER BY tipo_usuario";
    return ejecutarConsulta($query);
}

function getUsersWhitoutMe($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND  estado LIKE '1' ORDER BY tipo_usuario,nombre";
    return ejecutarConsulta($query);
}

function getOficeUsers($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario < 100) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
    return ejecutarConsulta($query);
}

function getProfesionalUsers($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario >= 100) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
    return ejecutarConsulta($query);
}



function getUsersWhitoutMeAndWhitoutProfessionals($id){
    $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario < 100 AND tipo_usuario >=70  ) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
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

function newGroup($nombre,$idUsuarios,$admin,$avatar){
    $nombre=limpiarCadena($nombre);
    $query="INSERT INTO `chat`(`tipo_chat`, `Nombre`, `id_usuarios`,`id_admin`,avatar) VALUES ('GRUPO','$nombre','$idUsuarios','$admin','$avatar')";
    return ejecutarConsulta_retornarID($query);
    //return $query;
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

function salirGrupo($idUser,$idChat){
    $idUser=$idUser.",";
    $query="UPDATE `chat` SET `id_usuarios`=REPLACE(id_usuarios,'$idUser','') ,`id_admin`=REPLACE(id_admin,'$idUser','') WHERE `idChat` LIKE '$idChat'";
    return ejecutarConsultaSimpleFila($query);
    //return $query;
}

function addGroupUser($idChat,$idUsuarios){
    $query="UPDATE `chat` SET `id_usuarios`=CONCAT(id_usuarios,'$idUsuarios') WHERE `idChat` LIKE '$idChat'";
    //return $query;
    return ejecutarConsultaSimpleFila($query);
}

function addGroupAdmin($idChat,$idUsuarios){
    $query="UPDATE `chat` SET `id_admin`=CONCAT(id_admin,'$idUsuarios') WHERE `idChat` LIKE '$idChat'";
    //return $query;
    return ejecutarConsultaSimpleFila($query);
}

function editGroup($idChat,$name,$avatar){
    $query="UPDATE `chat` SET Nombre='$name', avatar='$avatar' WHERE `idChat` LIKE '$idChat'";
    //return $query;
    return ejecutarConsultaSimpleFila($query);
}


}

?>