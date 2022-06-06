<?php 
require_once "con2.php";
date_default_timezone_set("Europe/Madrid");
$conexion=new mysqli(DB_HOST_2,DB_USERNAME_2,DB_PASSWORD_2,DB_NAME_2);


mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE_2.'"');

$conexion->set_charset('utf8mb4');
//muestra posible error en la conexion
if (mysqli_connect_errno()) {
	printf("Ups parece que falló en la conexion con la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta')) {
	Function ejecutarConsulta($sql){ 
global $conexion;
$query=$conexion->query($sql);
return $query;

	} 

	function ejecutarConsultaSimpleFila($sql){
global $conexion;

$query=$conexion->query($sql);
$row=$query->fetch_assoc();
return $row;
	}
function ejecutarConsulta_retornarID($sql){
global $conexion;
$query=$conexion->query($sql);
return $conexion->insert_id;
}

function limpiarCadena($str){
global $conexion;
$str=mysqli_real_escape_string($conexion,trim($str));
return htmlspecialchars($str);
}

}

 ?>