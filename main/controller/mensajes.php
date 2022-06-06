<?php 


session_start();


require_once '../model/mensajes.php';

$mensajes=new Mensajes();


require_once '../model/notificaciones.php';

$notificaciones=new Notificaciones();


if($_POST["action"]=="mensajes"){

    //if(isset($_POST["globalUser"]) && $_POST["globalUser"]!=0){
    //     $userMsg=$_POST["globalUser"];
    // }else{
        $userMsg=$_SESSION["id_user"];
    //}

    $result=$mensajes->leerMensajesChat($_POST['idChat'],$_POST['nMensajes']);
    while ($reg=$result->fetch_object()) {
        if($reg->id_usuario==$userMsg){
            $mensajePropio=true;
        }else{
            $mensajePropio=false;
        }

        $array = explode(",", $reg->leido);

        $text=$reg->text;

        $text=str_replace("\n", "<br>", $text);

        $data[]=array(
            "0"=>$text,
            "1"=>$reg->id_usuario,
            "2"=>$reg->fecha_hora,
            "3"=>$reg->leido,
            "4"=>$reg->nombre,
            "5"=>$mensajePropio,
            "6"=>$reg->id_mensaje,
            "7"=>sizeof($array)

        );
    }
    echo json_encode($data);
}

if($_POST["action"]=="insertar"){
    if(isset($_POST["globalUser"]) && $_POST["globalUser"]!=0){
        $mensajes->insertarMensaje($_POST['idChat'],$_POST['txt'],$_POST["globalUser"]);
        $notificaciones->generarNotificacion($_POST['idChat'],$_POST["globalUser"]);
}else{
    $mensajes->insertarMensaje($_POST['idChat'],$_POST['txt'],$_SESSION["id_user"]);
    $notificaciones->generarNotificacion($_POST['idChat'],$_SESSION["id_user"]);
}

 

}


if($_POST["action"]=="setLeido"){
    if(isset($_POST["globalUser"]) && $_POST["globalUser"]!=0){
        echo $mensajes->setLeido($_POST['mensajes'],$_POST["leido"],$_POST["globalUser"]);
     
    }else{
        echo $mensajes->setLeido($_POST['mensajes'],$_POST["leido"],$_SESSION["id_user"]);
        
    }

}

if($_POST["action"]=="setAllLeido"){
   
    if($_POST["user"]==""){
        $result=$mensajes->getIdChat($_SESSION["id_user"]);
        while ($reg=$result->fetch_object()) {
            echo $mensajes->setAllLeido($reg->idChat,$_SESSION["id_user"]);
        }
       
    }else{
        $result=$mensajes->getIdChat($_POST["user"]);
        while ($reg=$result->fetch_object()) {
            echo $mensajes->setAllLeido($reg->idChat,$_SESSION["id_user"]);
        }
    }
}



?>