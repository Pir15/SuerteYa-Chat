<?php

require_once '../config/Conexion.php';

Class Chat{


function listarChats($id){
    $string1="%,".$id.",%";
    $string2=$id.",%";
    $string3="%,".$id;
    $query="SELECT c.idChat,c.tipo_chat,c.Nombre,c.fecha_creacion,c.avatar FROM usuarios u, chat c WHERE (c.id_usuarios LIKE '$string1' OR c.id_usuarios LIKE '$string2' OR c.id_usuarios LIKE '$string3')   AND u.id_usuario LIKE '$id'";
    return ejecutarConsulta($query);
}

function buscarUsuariosChat($id_chat){
    $query="SELECT id_usuarios FROM `chat` WHERE `idChat` LIKE '$id_chat'";
    return ejecutarConsultaSimpleFila($query);
}

function buscarNombreUsuarioChat($id){
    $query="SELECT * FROM `usuarios` WHERE `id_usuario` LIKE '$id'";

    return ejecutarConsultaSimpleFila($query);   
}


function buscarUltimoMensaje($id_chat){
    $query="SELECT * FROM mensajes m, usuarios u WHERE m.id_chat LIKE '$id_chat'  AND m.id_usuario=u.id_usuario ORDER BY fecha_hora DESC LIMIT 1";
    return ejecutarConsultaSimpleFila($query);
   
}

function buscarNumeroMensajes($id_chat){
    $query="SELECT COUNT(*) AS mensajes FROM mensajes m, usuarios u WHERE m.id_chat LIKE '$id_chat' GROUP BY m.id_mensaje";
    return ejecutarConsultaSimpleFila($query);
   
}

function buscarMensajesPendientes($id_chat,$id_usuario){
    $string1="%,".$id_usuario.",%";
    $string2=$id_usuario.",%";
    $query="SELECT * FROM mensajes u WHERE u.id_chat LIKE '$id_chat'  AND u.id_usuario NOT LIKE '$id_usuario' AND (leido NOT LIKE '$string1'  AND leido NOT LIKE '$string2' ) GROUP BY u.id_mensaje";
    
    return ejecutarConsulta($query);
   
}

function buscarDatosChat($id){
    $query="SELECT * FROM chat WHERE idChat LIKE '$id'";
    return ejecutarConsultaSimpleFila($query);
}




}

?>