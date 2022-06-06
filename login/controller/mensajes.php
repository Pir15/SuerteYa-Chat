<?php 


session_start();


require_once '../model/mensajes.php';

$mensajes=new Mensajes();


require_once '../model/notificaciones.php';

$notificaciones=new Notificaciones();


if($_POST["action"]=="mensajes"){

    $result=$mensajes->leerMensajesChat($_POST['idChat'],$_POST['nMensajes']);
    while ($reg=$result->fetch_object()) {
        if($reg->id_usuario==$_SESSION["id_user"]){
            $mensajePropio=true;
        }else{
            $mensajePropio=false;
        }

        $array = explode(",", $reg->leido);


        $data[]=array(
            "0"=>$reg->text,
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
    $mensajes->insertarMensaje($_POST['idChat'],$_POST['txt'],$_SESSION["id_user"]);
    $notificaciones->generarNotificacion($_POST['idChat'],$_SESSION["id_user"]);

 

}


if($_POST["action"]=="setLeido"){
echo $mensajes->setLeido($_POST['mensajes'],$_POST["leido"],$_SESSION["id_user"]);
}



?>