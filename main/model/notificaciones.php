<?php

require_once '../config/Conexion.php';

require_once '../../notificaciones/FirebaseNotification.php';

Class Notificaciones{


function generarNotificacion($idChat,$idUserSender){

    $idUsers=Array();


    $query="SELECT id_usuarios FROM `chat` WHERE `idChat` LIKE '$idChat'";
    $result=ejecutarConsultaSimpleFila($query);

    $array = explode(",", $result["id_usuarios"]);
    foreach ($array as $usuario){
        if($usuario!=$idUserSender && $usuario!=""){
            array_push($idUsers, $usuario);
        }
    }

    foreach ($idUsers as $idUser){
        $query="SELECT tokenAndroid FROM usuarios WHERE id_usuario LIKE '$idUser'";
        $result2=ejecutarConsultaSimpleFila($query);
        $token=$result2["tokenAndroid"];

        $notification= array(
            'title'=>'SuerteYa Chat',
            'body' => 'Ha recibido un mensaje', 
            'tag' => 'new_messages'   
        );

        if($token!="" || $token!=NULL){
            sendNotification($token,$notification,"chat");
        }
        
    }

    }

    function generarNotificacionCliente($idChat){
        $query="SELECT  id_cliente FROM `consultas` WHERE `id_consulta` LIKE '$idChat'";
        //return $query;
        $result=ejecutarConsultaSimpleFila_2($query);
        $idCli=$result["id_cliente"];
    
        $query2="SELECT tokenAndroid FROM clientes WHERE idcliente LIKE '$idCli'";
            $result2=ejecutarConsultaSimpleFila_3($query2);
            $token=$result2["tokenAndroid"];
    
            $notification= array(
                'title'=>'SuerteYa App',
                'body' => 'Su Consulta ha sido respondida', 
                'tag' => 'new_messages'   
            );
    
            if($token!="" || $token!=NULL){
                sendNotification($token,$notification,"app");
            }
            return $token;
            
        }
}

?>