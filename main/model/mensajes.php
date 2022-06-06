<?php

require_once '../config/Conexion.php';

Class Mensajes{


function leerMensajesChat($id,$nMensajes){
    $query="SELECT * FROM `mensajes` m, usuarios s WHERE `id_chat` = '$id' AND m.id_usuario LIKE s.id_usuario ORDER BY fecha_hora DESC LIMIT $nMensajes";
    return ejecutarConsulta($query);
    //return $query;
}

function insertarMensaje($id_chat,$txt,$id_user){
    $now = date("Y-m-d H:i:s");
    $txt=limpiarCadena($txt);
    $query="INSERT INTO `mensajes`( `text`, `id_usuario`, `id_chat`, `fecha_hora`,`leido`) VALUES  ('$txt','$id_user','$id_chat','$now','')";
     ejecutarConsulta($query);
 
    
}

function setLeido($array,$leido,$id){
    $str=$id.",";
    $str2="";
   for($i=0;$i<sizeof($array);$i++){     
    if($i==0){
        $str2="id_mensaje LIKE '$array[$i]'  ";
    }else{
        $str2= $str2."OR id_mensaje LIKE '$array[$i]'"; 
    }
     }
     
     $query="UPDATE `mensajes` SET leido = CONCAT(leido,'$str') WHERE ($str2) AND (leido NOT LIKE '$str%' AND leido NOT LIKE '%,$str%' )";
     ejecutarConsultaSimpleFila($query);
}


function getIdChat($channel){

    $query="SELECT idChat from chat WHERE (id_usuarios LIKE '$channel,%' OR id_usuarios LIKE '%,$channel,%' )";
    return ejecutarConsulta($query);
}
function setAllLeido($idChat,$id){
    $str=$id.",";
    $query="UPDATE `mensajes` SET leido = CONCAT(leido,'$str') WHERE id_chat LIKE '$idChat' AND (leido NOT LIKE '$str%' AND leido NOT LIKE '%,$str%' )";
    ejecutarConsulta($query);
    return $query."; ";
}



function leerMensajesConsulta($id,$nMensajes){
    $query="SELECT * FROM `mensajes` WHERE `id_chat` = '$id'  ORDER BY fecha_hora DESC LIMIT $nMensajes";
    return ejecutarConsulta_2($query);
    //return $query;
}

function insertarConsulta($id_chat,$txt,$id_user,$car){
    $txt=limpiarCadena($txt);
    $query="INSERT INTO `mensajes`( `text`, `id_tar`, `id_chat`,`caracteres`) VALUES  ('$txt','$id_user','$id_chat','$car')";
    ejecutarConsulta_2($query);
   
}

function setLeidoConsultas($array){
   for($i=0;$i<sizeof($array);$i++){     
    if($i==0){
        $str2="id_mensaje LIKE '$array[$i]'  ";
    }else{
        $str2= $str2."OR id_mensaje LIKE '$array[$i]'"; 
    }
     }
     
     $query="UPDATE `mensajes` SET leido = '1' WHERE ($str2) ";
     ejecutarConsultaSimpleFila_2($query);
}





}

?>