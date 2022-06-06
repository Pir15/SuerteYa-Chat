<?php

session_start();
require_once '../model/AdminUsers.php';

$admin=new AdminUsers();

if($_POST["action"]=="getUsers"){


     $result=$admin->getUsers();

     while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->id_usuario,
            "1"=>$reg->nombre,
            "2"=>$reg->apellidos,
            "3"=>$reg->usuario,
            "4"=>$reg->avatar,
            "5"=>$reg->permisos,
            "6"=>$reg->estado,
        );
    }

    echo json_encode($data);


}


if($_POST["action"]=="getProfesionales"){


    $result=$admin->getProfesionales();

    while ($reg=$result->fetch_object()) {
       $data[]=array(
           "0"=>$reg->id_usuario,
           "1"=>$reg->nombre,
           "2"=>$reg->apellidos,
           "3"=>$reg->usuario,
           "4"=>$reg->avatar,
           "5"=>$reg->permisos,
           "6"=>$reg->estado,
       );
   }

   echo json_encode($data);


}

if(isset($_GET["alta"])){
    $admin->alta($_GET["alta"]);
    header('Location:' . getenv('HTTP_REFERER'));
}

if(isset($_GET["baja"])){
    $admin->baja($_GET["baja"]);
    header('Location:' . getenv('HTTP_REFERER'));
}

if(isset($_GET["delete"])){
    $admin->delete($_GET["delete"]);
    header('Location:' . getenv('HTTP_REFERER'));
}



  




?>