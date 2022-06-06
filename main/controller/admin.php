<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../model/administracion.php';
require_once '../model/contactos.php';
require_once '../model/mensajes.php';

$admin=new Admin();

$contactos=new Contactos();

$mensajes=new Mensajes();

$data=Array();

$idadmin=187;



if($_POST["action"]=="listarChat"){
    $arrayChats=[];
    $result=$admin->listarChats($idadmin);
    
    while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->idChat,
            "1"=>$reg->tipo_chat,
            "2"=>$reg->Nombre,
            "3"=>$reg->fecha_creacion,
            "4"=>$reg->avatar,
        );
    }

    for($i=0;$i<sizeof($data);$i++){
        $idChat=$data[$i][0];
        $tipoChat=$data[$i][1];
        $nombreChat=$data[$i][2];
        $fechaChat=$data[$i][3];
        $avatar=$data[$i][4];

        if($nombreChat==""){
            $result=$admin->buscarUsuariosChat($idChat);
            $array = explode(",", $result["id_usuarios"]);
                foreach ($array as $usuario){
                    if($usuario!=$idadmin && $usuario!=""){
                        $usr=$usuario;
                    }
                }
            $result=$admin->buscarNombreUsuarioChat($usr);
            $nombreChat=$result["nombre"];
            $permisos=$result["tipo_usuario"];
            $avatar=$result["avatar"];
         }else{
            $permisos="GRUPO";
         }


        $result=$admin->buscarUltimoMensaje($idChat);
        if($result!=null){
            $text=$result["text"];
            $date=$result["fecha_hora"];
            $user=$result["nombre"];
        }else{
            $text="";
            $date="";
            $user="";;
        }


        $result=$admin->buscarMensajesPendientes($idChat,$_SESSION['id_user']);
        $nMensajes=0;
        if($result!=null){
            $nMensajes=$result->num_rows;
        }
       
          $data2=array(
            "0"=>$idChat,
            "1"=>$tipoChat,
            "2"=>$nombreChat,
            "3"=>$fechaChat,
            "4"=>$text,
            "5"=>$date,
            "6"=>$nMensajes,
            "7"=>$user,
            "8"=>$permisos,
            "9"=>$avatar,
        );
        //echo json_encode($data2);
        array_push($arrayChats,$data2);


    }

    echo json_encode($arrayChats);
   
}

if($_POST["action"]=="chatData2"){
    $result=$admin->buscarDatosChat($_POST["id_chat"]);

    $nombre=$result["Nombre"];
    $permisos=-1;
    $avatar=$result["avatar"];
    $result2=$admin->buscarUsuariosChat($_POST["id_chat"]);
    $array = explode(",", $result["id_usuarios"]);
    foreach ($array as $usuario){
        if($usuario!=$idadmin && $usuario!=""){
            $usr=$usuario;
        }
    }

    if($nombre==NULL){
        $result=$admin->buscarNombreUsuarioChat($_POST["id_chat"],$_SESSION["id_user"]);
        $result=$admin->buscarNombreUsuarioChat($usr);
        $nombre=$result["nombre"];
        $permisos=$result["tipo_usuario"];
        $avatar=$result["avatar"];
    }  

    $data=array(
        "0"=>$nombre,
        "1"=>sizeof($array),
        "2"=>$permisos,
        "3"=>$avatar,
    );
    
    echo json_encode($data);
}


if($_POST["action"]=="chatData3"){
    $result=$admin->buscarNombreUsuarioChat($_POST["id_user"]);
     $nombre=$result["nombre"]; 
     $permisos=$result["tipo_usuario"]; 
     $avatar=$result["avatar"];
    
    $data=array(
        "0"=>$nombre,
        "1"=>$permisos,
        "2"=>$avatar,
    );
    
    echo json_encode($data);

}

if($_POST["action"]=="startChat"){
    $string=$_POST["id_user"].",".$_SESSION["id_user"].",";
    $id_chat=$contactos->newChat($string);
    $mensajes->insertarMensaje($id_chat,$_POST["txt"],$_SESSION["id_user"]);
    echo $id_chat;
}




?>