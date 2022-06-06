<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../model/ventanilla.php';
require_once '../model/contactos.php';
require_once '../model/mensajes.php';

$ventanilla=new Ventanilla();

$contactos=new Contactos();

$mensajes=new Mensajes();

$data=Array();

$idVentanilla=18;



if($_POST["action"]=="listarChat"){
    $arrayChats=[];
    $result=$ventanilla->listarChats($idVentanilla);
    
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
            $result=$ventanilla->buscarUsuariosChat($idChat);
            $array = explode(",", $result["id_usuarios"]);
                foreach ($array as $usuario){
                    if($usuario!=$idVentanilla && $usuario!=""){
                        $usr=$usuario;
                    }
                }
            $result=$ventanilla->buscarNombreUsuarioChat($usr);
            $nombreChat=$result["nombre"];
            $permisos=$result["tipo_usuario"];
            $avatar=$result["avatar"];
         }else{
            $permisos="GRUPO";
         }


        $result=$ventanilla->buscarUltimoMensaje($idChat);
        if($result!=null){
            $text=$result["text"];
            $date=$result["fecha_hora"];
            $user=$result["nombre"];
        }else{
            $text="";
            $date="";
            $user="";;
        }


        $result=$ventanilla->buscarMensajesPendientes($idChat,$_SESSION['id_user']);
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
    $result=$ventanilla->buscarDatosChat($_POST["id_chat"]);

    $nombre=$result["Nombre"];
    $permisos=-1;
    $avatar=$result["avatar"];
    $result2=$ventanilla->buscarUsuariosChat($_POST["id_chat"]);
    $array = explode(",", $result["id_usuarios"]);
    foreach ($array as $usuario){
        if($usuario!=$idVentanilla && $usuario!=""){
            $usr=$usuario;
        }
    }

    if($nombre==NULL){
        $result=$ventanilla->buscarNombreUsuarioChat($_POST["id_chat"],$_SESSION["id_user"]);
        $result=$ventanilla->buscarNombreUsuarioChat($usr);
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
    $result=$ventanilla->buscarNombreUsuarioChat($_POST["id_user"]);
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