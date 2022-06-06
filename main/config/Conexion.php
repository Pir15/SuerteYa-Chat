<?php 
//ip de la pc servidor base de datos
define("DB_HOST", "localhost");

// nombre de la base de datos
define("DB_NAME", "suerteya_chat");


//nombre de usuario de base de datos
define("DB_USERNAME", "suerteya_fichaje");
//define("DB_USERNAME", "u222417_admin");

//conraseña del usuario de base de datos
define("DB_PASSWORD", "Cacatua1800*");
//define("DB_PASSWORD", "Enero2020Admin");

//codificacion de caracteres
define("DB_ENCODE", "utf8");

date_default_timezone_set("Europe/Madrid");
$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
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