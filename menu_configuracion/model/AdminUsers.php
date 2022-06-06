<?php

require_once '../config/Conexion.php';

Class AdminUsers{

   function getUsers(){
       $query='SELECT id_usuario, u.nombre AS "nombre", apellidos, usuario, avatar, p.nombre AS "permisos",estado FROM usuarios u,permisos p WHERE u.tipo_usuario=p.idPermiso ORDER BY p.idPermiso';
        return ejecutarConsulta($query);
   }

   function getProfesionales(){
      $query='SELECT id_usuario, u.nombre AS "nombre", apellidos, usuario, avatar, p.nombre AS "permisos",estado FROM usuarios u,permisos p WHERE u.tipo_usuario=p.idPermiso AND p.idPermiso LIKE "100" ORDER BY p.idPermiso';
       return ejecutarConsulta($query);
  }

   function alta($id){
      $query="UPDATE `usuarios` SET `estado`='1' WHERE id_usuario like '$id'";
      return ejecutarConsulta($query);
   }

   function baja($id){
      $query="UPDATE `usuarios` SET `estado`='0' WHERE id_usuario like '$id'";
      return ejecutarConsulta($query);
   }

//    function delete($id){
//       $string1="%,".$id.",%";
//       $string2=$id.",%";
//       $string3="%,".$id;

//       $query="DELETE FROM `chat` WHERE (id_usuarios LIKE '$string1' OR id_usuarios LIKE '$string2' OR id_usuarios LIKE '$string3') AND tipo_chat LIKE 'INDIVIDUAL' ";
//        ejecutarConsulta($query);
//       $query="DELETE FROM `usuarios` WHERE id_usuario like '$id'";
//        ejecutarConsulta($query);
//    }
}

?>