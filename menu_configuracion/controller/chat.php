<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../model/chat.php';
require_once '../model/contactos.php';
require_once '../model/mensajes.php';

$chat=new Chat();

$contactos=new Contactos();

$mensajes=new Mensajes();

$data=Array();



if($_POST["action"]=="listarChat"){
    $arrayChats=[];
    $result=$chat->listarChats($_SESSION["id_user"]);
    
    while ($reg=$result->fetch_object()) {
        $data[]=array(
            "0"=>$reg->idChat,
            "1"=>$reg->tipo_chat,
            "2"=>$reg->Nombre,
            "3"=>$reg->fecha_creacion,
        );
    }

    for($i=0;$i<sizeof($data);$i++){
        $idChat=$data[$i][0];
        $tipoChat=$data[$i][1];
        $nombreChat=$data[$i][2];
        $fechaChat=$data[$i][3];

        if($nombreChat==""){
            $result=$chat->buscarUsuariosChat($idChat);
            $array = explode(",", $result["id_usuarios"]);
                foreach ($array as $usuario){
                    if($usuario!=$_SESSION['id_user'] && $usuario!=""){
                        $usr=$usuario;
                    }
                }
            $result=$chat->buscarNombreUsuarioChat($usr);
            $nombreChat=$result["nombre"];
            $permisos=$result["tipo_usuario"];
         }else{
            $permisos="GRUPO";
         }


        $result=$chat->buscarUltimoMensaje($idChat);
        if($result!=null){
            $text=$result["text"];
            $date=$result["fecha_hora"];
            $user=$result["nombre"];
        }else{
            $text="";
            $date="";
            $user="";;
        }


        $result=$chat->buscarMensajesPendientes($idChat,$_SESSION["id_user"]);
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
        );
        //echo json_encode($data2);
        array_push($arrayChats,$data2);


    }

    echo json_encode($arrayChats);
   
}

if($_POST["action"]=="chatData2"){
    $result=$chat->buscarDatosChat($_POST["id_chat"]);

    $nombre=$result["Nombre"];
    $permisos=-1;
    $result2=$chat->buscarUsuariosChat($_POST["id_chat"]);
    $array = explode(",", $result["id_usuarios"]);
    foreach ($array as $usuario){
        if($usuario!=$_SESSION['id_user'] && $usuario!=""){
            $usr=$usuario;
        }
    }

    if($nombre==NULL){
        $result=$chat->buscarNombreUsuarioChat($_POST["id_chat"],$_SESSION["id_user"]);
        $result=$chat->buscarNombreUsuarioChat($usr);
        $nombre=$result["nombre"];
        $permisos=$result["tipo_usuario"];
    }  

    $data=array(
        "0"=>$nombre,
        "1"=>sizeof($array),
        "2"=>$permisos,
    );
    
    echo json_encode($data);
}


if($_POST["action"]=="chatData3"){
    $result=$chat->buscarNombreUsuarioChat($_POST["id_user"]);
    echo $nombre=$result["nombre"];   
}

if($_POST["action"]=="startChat"){
    $string=$_POST["id_user"].",".$_SESSION["id_user"].",";
    $id_chat=$contactos->newChat($string);
    $mensajes->insertarMensaje($id_chat,$_POST["txt"],$_SESSION["id_user"]);
    echo $id_chat;
}




?>