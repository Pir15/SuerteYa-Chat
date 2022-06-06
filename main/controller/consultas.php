<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../model/consultas.php';
require_once '../model/contactos.php';
require_once '../model/clientes.php';
require_once '../model/mensajes.php';
require_once '../model/notificaciones.php';

$consultas=new Consultas();

// $contactos=new Contactos();
$cliente=new Clientes(); 
$mensajes=new Mensajes();
$notificaciones=new Notificaciones();

$data=Array();


$result=$consultas->buscarIdProfesional($_SESSION["id_user"]);
$id_tar=$result["id_tar"];

if($_POST["action"]=="datosChat"){  

   $result=$consultas->buscarIdCliente($_POST["id_chat"]);
   $result1=$cliente->datosCliente($result["id_cliente"]);
 


   $data=array(
     "0"=>$result1["namecliente"]
  );

  echo json_encode($data);
}


if($_POST["action"]=="listar"){  
$result=$consultas->listarChats($id_tar);
  while ($reg=$result->fetch_object()) {
      $result1=$cliente->datosCliente($reg->id_cliente);
    


  //   $result1=$contactos->getDatos($id_tar);
  // $result2=$contactos->getEstado($id_tar);
   $result2=$consultas->buscarUltimoMensaje($reg->id_consulta);
  
   if($result2!=NULL){
     
  
  if($result2["id_cliente"]!=null){
    $nombre="Yo";
  }

  if($result2["id_tar"]!=null){
      $nombre=$result1["namecliente"];
  }

  $result3=$consultas->mensajesSinLeer($reg->id_consulta);



    $data[]=array(
      "0"=>$reg->id_consulta,
      "1"=>$result1["namecliente"],
      "2"=>$result2["text"],
      "3"=>$nombre,
      "4"=> $result3["pendientes"],
      "5"=> $result2["fecha_hora"]
    );
  }
  }


  echo json_encode($data);
}

if($_POST["action"]=="mensajes"){
  $result=$mensajes->leerMensajesConsulta($_POST["idChat"],$_POST["nMensajes"]);
  while ($reg=$result->fetch_object()) {

    if($reg->id_cliente!=null){
      $result1=$cliente->datosCliente($reg->id_cliente);
      $nombre=$result1["namecliente"];
      $mensajePropio=false;
    }
  
    if($reg->id_tar!=null){
      $nombre="Yo";
      $mensajePropio=true;
    }

    $data[]=array(
      "0"=>$reg->id_mensaje,
      "1"=>$reg->text,
      "2"=>$nombre,
      "3"=>$reg->fecha_hora,
      "4"=>$mensajePropio
    );
  }
  echo json_encode($data);

}

if($_POST["action"]=="insertarConsulta"){  
  $mensajes->insertarConsulta($_POST["idChat"],$_POST["txt"],$id_tar,$_POST["car"]);
 echo $notificaciones->generarNotificacionCliente($_POST['idChat']);
}

if($_POST["action"]=="setLeido"){
  $mensajes->setLeidoConsultas($_POST["mensajes"]);
}



