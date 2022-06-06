<?php 

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../model/contactos.php';

$contactos=new Contactos();

if(isset($_POST["canal"])){
  switch ($_POST["canal"]) {
    case "oficina":
       $userCont=$_SESSION["id_user"];
        break;
    case "ventanilla":
        $userCont=18;
        break;
    case "centralita":
        $userCont=19;
        break;
    case "tecnico":
        $userCont=21;
        break;
    case "admin":
        $userCont=187;
        break;
    case "suerteya":
        $userCont=$_SESSION["id_user"];
    break;
}
}




if($_POST["action"]=="listarContactos"){

if($_SESSION["permisos"]<100){
    if($userCont==$_SESSION["id_user"]){
        $result=$contactos->getOficeUsers($userCont); 
    }else{
        $result=$contactos->getProfesionalUsers($userCont);
    }
    
}else{
    $result=$contactos->getUsersWhitoutMeAndWhitoutProfessionals($_SESSION["id_user"]);
}
    
    
    while ($reg=$result->fetch_object()) {

        $result2=$contactos->buscarChat($reg->id_usuario,$userCont);
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
            "4"=>$reg->avatar,
        );
    }
    echo json_encode($data);

}

if($_POST["action"]=="listarContactos2"){

    $result=$contactos->getUsers();
    
    while ($reg=$result->fetch_object()) {
        if($reg->id_usuario!=$_SESSION["id_user"]){
            $data[]=array(
                "0"=>$reg->id_usuario,
                "1"=>$reg->nombre,
                "2"=>$reg->tipo_usuario,
                "3"=>$reg->avatar,
            );
        }
    }
    echo json_encode($data);

}

if($_POST["action"]=="newGroup"){
    
    $string="";
    

    foreach($_POST["userList"] as $user){
       $string=$string.$user.",";
    }

    $admin=$_SESSION["id_user"].",";
    $string=$string.$admin;


    if(isset($_FILES["upfile"]["tmp_name"]) && $_FILES["upfile"]["name"]!=""){
        $dir = "../../img/avatar/";
        move_uploaded_file($_FILES["upfile"]["tmp_name"], $dir. $date."_".$_FILES["upfile"]["name"]);
        $avatar= $date."_".$_FILES["upfile"]["name"];
    }else{
        $avatar="";
    }

    echo $avatar;

   $result=$contactos->newGroup($_POST["nombre"],$string,$admin,$avatar);
    echo $result;

}

if($_POST["action"]=="salirGrupo"){
    $result=$contactos->salirGrupo($_SESSION["id_user"],$_POST["idChat"]); 
}


if($_POST["action"]=="addGroupUser"){
    $string="";
    foreach($_POST["userList"] as $user){
        $string=$string.$user.",";
     }

    echo $result=$contactos->addGroupUser($_POST["idChat"],$string);
}

if($_POST["action"]=="addGroupAdmin"){
    $string="";
    foreach($_POST["userList"] as $user){
        $string=$string.$user.",";
     }

    echo $result=$contactos->addGroupAdmin($_POST["idChat"],$string);
}

if($_POST["action"]=="editGroup"){
      echo $result=$contactos->editGroup($_POST["idChat"],$_POST["name"],$_POST["avatar"]);
}





?>