<?php

require_once '../config/Conexion.php';

Class User{

   function createUser($name,$apellidos,$email,$user,$passwd,$tel,$permisos,$avatar){
         $name=limpiarCadena($name);
         $apellidos=limpiarCadena($apellidos);
         $email=limpiarCadena($email);
         $user=limpiarCadena($user);
         $passwd=limpiarCadena($passwd);

       $query="INSERT INTO `usuarios`(`nombre`, `apellidos`, `email`, `passwd`, `usuario`, `telefono`, `tipo_usuario`, `avatar`) VALUES ('$name','$apellidos','$email','$passwd','$user','$tel','$permisos','$avatar')";
        return ejecutarConsulta($query);
   }

   function changeAvatar($id,$avatar){
      $query="UPDATE `usuarios` SET `avatar`='$avatar' WHERE `id_usuario` LIKE '$id' ";
      return ejecutarConsulta($query);
   }

   function changePasswd($id,$passwd){
      $passwd=limpiarCadena($passwd);
      $query="UPDATE `usuarios` SET `passwd`='$passwd' WHERE `id_usuario` LIKE '$id' ";
      return ejecutarConsulta($query);
   }

   function editUser($id,$name,$apellidos,$email,$user,$tel,$permisos){
      $name=limpiarCadena($name);
      $apellidos=limpiarCadena($apellidos);
      $email=limpiarCadena($email);
      $user=limpiarCadena($user);
      $passwd=limpiarCadena($passwd);

      $query="UPDATE `usuarios` SET `nombre`='$name',`apellidos`='$apellidos',`email`='$email'
      ,`usuario`='$user',`telefono`='$tel',`tipo_usuario`='$permisos' WHERE `id_usuario` LIKE '$id' ";
      return ejecutarConsulta($query);
   }
   
}

?>