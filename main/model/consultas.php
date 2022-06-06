<?php

require_once '../config/Conexion.php';
//require_once '../config/Conexion_2.php';
require_once '../config/Conexion_3.php';

Class Consultas{

function buscarIdProfesional($id){
    $query="SELECT id_tar FROM `usuarios` WHERE `id_usuario` LIKE '$id'";
    return ejecutarConsultaSimpleFila($query);    
 }

 function buscarIdCliente($id){
    $query="SELECT id_cliente FROM `consultas` WHERE id_consulta LIKE '$id'";
    return ejecutarConsultaSimpleFila_2($query);    
 }

 function listarChats($id){
    $query="SELECT * FROM consultas WHERE id_tar LIKE '$id'";
        return ejecutarConsulta_2($query);
}

function buscarUltimoMensaje($id_chat){
    $query="SELECT * FROM mensajes WHERE id_chat LIKE '$id_chat' ORDER BY fecha_hora DESC LIMIT 1";
    return ejecutarConsultaSimpleFila_2($query);
}

function mensajesSinLeer($id_chat){
    $query="SELECT COUNT(*) AS pendientes FROM `mensajes` WHERE id_chat LIKE '$id_chat' AND `id_cliente` IS NOT NULL AND `leido` LIKE '0'";
    return ejecutarConsultaSimpleFila_2($query);
}


// function buscarChat($id){
//     $query="SELECT * FROM `consultas` WHERE `id_consulta` LIKE '$id'";
//     return ejecutarConsultaSimpleFila_2($query);
// }



// function getChatProfesional($id_chat){
//     $query="SELECT * FROM `consultas` WHERE `id_consulta` LIKE '$id_chat' ";
//     return ejecutarConsultaSimpleFila_2($query);
// }

// function buscarNombreUsuarioChat($id){
//     $query="SELECT * FROM `plantilla` WHERE `id_tar` LIKE '$id'";
//     return ejecutarConsultaSimpleFila($query);   
// }



// function buscarNumeroMensajes($id_chat){
//     $query="SELECT COUNT(*) AS mensajes FROM mensajes m, usuarios u WHERE m.id_chat LIKE '$id_chat' GROUP BY m.id_mensaje";
//     return ejecutarConsultaSimpleFila($query);
   
// }



// function buscarDatosChat($id){
//     $query="SELECT * FROM chat WHERE idChat LIKE '$id'";
//     return ejecutarConsultaSimpleFila($query);
// }




}

?>