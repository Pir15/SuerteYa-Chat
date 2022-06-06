<?php 

//ip de la pc servidor base de datos
define("DB_HOST_3", "angelmediatec.ddns.net");

//puerto de la pc servidor base de datos
define("DB_PORT_3", 17400); 
// nombre de la base de datos
define("DB_NAME_3", "mydatabase");

//nombre de usuario de base de datos
define("DB_USERNAME_3", "web");
//define("DB_USERNAME", "u222417_admin");

//conraseña del usuario de base de datos
define("DB_PASSWORD_3", "zxZX123");
//define("DB_PASSWORD", "Enero2020Admin");

//codificacion de caracteres
define("DB_ENCODE_3", "utf8");

date_default_timezone_set("Europe/Madrid");

$conexion_3=new mysqli(DB_HOST_3,DB_USERNAME_3,DB_PASSWORD_3,DB_NAME_3,DB_PORT_3);

mysqli_query($conexion_3, 'SET NAMES "'.DB_ENCODE_3.'"');

$conexion_3->set_charset('utf8mb4');
//muestra posible error en la conexion
if (mysqli_connect_errno()) {
	printf("Ups parece que falló en la conexion con la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta_3')) {
	Function ejecutarConsulta_3($sql){ 
global $conexion_3;
$query=$conexion_3->query($sql);
return $query;

	} 

	function ejecutarConsultaSimpleFila_3($sql){
global $conexion_3;

$query=$conexion_3->query($sql);
$row=$query->fetch_assoc();
return $row;
	}
function ejecutarConsulta_retornarID_3($sql){
global $conexion_3;
$query=$conexion_3->query($sql);
return $conexion_3->insert_id;
}

function limpiarCadena_3($str){
global $conexion_3;
$str=mysqli_real_escape_string($conexion_3,trim($str));
return htmlspecialchars($str);
}

}

 ?>