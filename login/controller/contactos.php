<?php 

session_start();


require_once '../model/contactos.php';

$contactos=new Contactos();



if($_POST["action"]=="listarContactos"){

if($_SESSION["permisos"]<100){
    $result=$contactos->getUsersWhitoutMe($_SESSION["id_user"]);
}else{
    $result=$contactos->getUsersWhitoutMeAndWhitoutProfessionals($_SESSION["id_user"]);
}
    
    
    while ($reg=$result->fetch_object()) {

        $result2=$contactos->buscarChat($reg->id_usuario,$_SESSION["id_user"]);
        if($result2==NULL){
            $idChat=0;
        }else{
            $idChat=$result2["idChat"];
        }

        $data[]=array(
            "0"=>$reg->id_usuario,
            "1"=>$reg->nombre,
            "2"=>$reg->tipo_usuario,
            "3"=>$idChat,
        );
    }
    echo json_encode($data);

}

if($_POST["action"]=="listarContactos2"){

    $result=$contactos->getUsers();
    
    while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->id_usuario,
            "1"=>$reg->nombre,
            "2"=>$reg->tipo_usuario,
        );
    }
    echo json_encode($data);

}

if($_POST["action"]=="newGroup"){
    $string="";
    

    foreach($_POST["userList"] as $user){
       $string=$string.$user.",";
    }

    $admin=$_SESSION["id_user"].",";

    $result=$contactos->newGroup($_POST["nombre"],$string,$admin);
    echo $result;

}


if($_POST["action"]=="buscarChat"){

   
    

}


?>