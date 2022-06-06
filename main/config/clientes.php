<?php

require_once '../config/Conexion.php';


require_once '../config/Conexion_2.php';


require_once '../config/Conexion_3.php';

Class Clientes{

    function datosCliente($id_cli){
        $query="SELECT * FROM `consultas` WHERE `id_cliente` LIKE '$id_cli'";
        return ejecutarConsultaSimpleFila_3($query);
    }


// function getSaldo($id){
//     $query="SELECT saldo FROM clientes WHERE idcliente LIKE '$id'";
//     return ejecutarConsultaSimpleFila($query);
// }

// function restarSaldo($id,$precio){
//     $query="UPDATE `clientes` SET saldo=saldo-$precio WHERE idcliente LIKE '$id'";
//     return ejecutarConsultaSimpleFila($query);
// }

// function iniciarConsulta($idCliente,$id_tar){
//     $query="INSERT INTO `consultas`(`id_cliente`, `id_tar`) VALUES ('$idCliente','$id_tar')";
//     return ejecutarConsulta_retornarID_2($query);
// }

//  function buscarChat($id_tar,$id_cli){
//     $query="SELECT * FROM `consultas` WHERE `id_cliente` LIKE '$id_cli' AND `id_tar` LIKE '$id_tar'";
//     return ejecutarConsultaSimpleFila_2($query);
// }








// function getGruposWhitoutMe($id){
//     $query="SELECT tipo_usuario, count(tipo_usuario) AS numero FROM usuarios WHERE id_usuario NOT LIKE '$id' GROUP BY tipo_usuario,nombre";
//     return ejecutarConsulta($query);
// }

// function getUsers(){
//     $query="SELECT * FROM usuarios WHERE estado LIKE '1'";
//     return ejecutarConsulta($query);
// }

// function getUsersWhitoutMe($id){
//     $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND  estado LIKE '1' ORDER BY tipo_usuario,nombre";
//     return ejecutarConsulta($query);
// }

// function getOficeUsers($id){
//     $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario < 100) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
//     return ejecutarConsulta($query);
// }

// function getProfesionalUsers($id){
//     $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario >= 100) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
//     return ejecutarConsulta($query);
// }



// function getUsersWhitoutMeAndWhitoutProfessionals($id){
//     $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND ( tipo_usuario < 100 AND tipo_usuario >=70  ) AND estado LIKE '1'ORDER BY tipo_usuario,nombre";
//     return ejecutarConsulta($query);
// }

// function getUsersbyType($type){
//     $query="SELECT * FROM usuarios WHERE tipo_usuario LIKE '$type' ORDER BY usuario";
//     return ejecutarConsulta($query);
// }

// function getUsersbyTypeWhitoutMe($type,$id){
//     $query="SELECT * FROM usuarios WHERE id_usuario NOT LIKE '$id' AND  tipo_usuario LIKE '$type' ORDER BY usuario";
//     return ejecutarConsulta($query);
    
// }

// function newGroup($nombre,$idUsuarios,$admin){
//     $query="INSERT INTO `chat`(`tipo_chat`, `Nombre`, `id_usuarios`,`id_admin`) VALUES ('GRUPO','$nombre','$idUsuarios','$admin')";
//     return ejecutarConsulta_retornarID($query);
// }

// function newChat($idUsuarios){
//     $query="INSERT INTO `chat`(`tipo_chat`, `id_usuarios`) VALUES ('INDIVIDUAL','$idUsuarios')";
//     //return $query;
//     return ejecutarConsulta_retornarID($query);
// }

// function buscarChat($idUser,$myId){
    
//     $query="SELECT * FROM `chat` WHERE (
//         (id_usuarios LIKE '%,$idUser,%' AND id_usuarios LIKE '%,$myId,%') 
//         OR (id_usuarios LIKE '$idUser,%' AND id_usuarios LIKE '$myId,%')
//         OR (id_usuarios LIKE '%,$idUser,%' AND id_usuarios LIKE '$myId,%')
//         OR (id_usuarios LIKE '$idUser,%' AND id_usuarios LIKE '%,$myId,%')
//         ) AND tipo_chat LIKE 'INDIVIDUAL'";
//     return ejecutarConsultaSimpleFila($query);
//     //return $query;


// }


}

?>