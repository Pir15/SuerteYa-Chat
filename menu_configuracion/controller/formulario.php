<?php

session_start();
require_once '../model/Formulario.php';

$formulario=new Formulario();

if($_POST["action"]=="getPermisos"){

   if( $_SESSION['permisos']<=5){
    $result=$formulario->getPermisos();
   }else{
    $result=$formulario->getPermisos2();
   }
    while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->idPermiso,
            "1"=>$reg->nombre,
            "2"=>$reg->descripcion,
        );
    }

    echo json_encode($data);
}

if($_POST["action"]=="getPermisos2"){

    
     $result=$formulario->getPermisos();
     while ($reg=$result->fetch_object()) {
         $data[]=array(
             "0"=>$reg->idPermiso,
             "1"=>$reg->nombre,
             "2"=>$reg->descripcion,
         );
     }
 
     echo json_encode($data);
 }


if($_POST["action"]=="getUserData"){

    if($_POST["idUser"]!=''){
        $id=$_POST["idUser"];
    }else{
        $id=$_SESSION["id_user"];
    }
    $result=$formulario->getUserData($id);
    
    while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->id_usuario,
            "1"=>$reg->nombre,
            "2"=>$reg->apellidos,
            "3"=>$reg->email,
            "4"=>$reg->usuario,
            "5"=>$reg->telefono,
            "6"=>$reg->tipo_usuario,
            "7"=>$reg->avatar,
        );
    }

    echo json_encode($data);
}



  




?>