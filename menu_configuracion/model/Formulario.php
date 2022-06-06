<?php

require_once '../config/Conexion.php';

Class Formulario{

   function getPermisos(){
       $query="SELECT * FROM `permisos` WHERE idPermiso !=0";
       return ejecutarConsulta($query);
   }

   function getPermisos2(){
    $query="SELECT * FROM `permisos` WHERE idPermiso =100";
    return ejecutarConsulta($query);
    }


    function getUserData($id){
        $query="SELECT * FROM `usuarios` WHERE id_usuario LIKE '$id'";
        return ejecutarConsulta($query);
        }



}

?>