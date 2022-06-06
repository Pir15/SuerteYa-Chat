<?php 
//ip de la pc servidor base de datos
define("DB_HOST_2", "localhost");

// nombre de la base de datos
define("DB_NAME_2", "suerteya_app");


//nombre de usuario de base de datos
define("DB_USERNAME_2", "suerteya_fichaje");
//define("DB_USERNAME", "u222417_admin");

//conraseña del usuario de base de datos
define("DB_PASSWORD_2", "Cacatua1800*");
//define("DB_PASSWORD", "Enero2020Admin");

//codificacion de caracteres
define("DB_ENCODE_2", "utf8");

date_default_timezone_set("Europe/Madrid");
$conexion_2=new mysqli(DB_HOST_2,DB_USERNAME_2,DB_PASSWORD_2,DB_NAME_2);

mysqli_query($conexion_2, 'SET NAMES "'.DB_ENCODE_2.'"');
$conexion_2->set_charset('utf8mb4');
//muestra posible error en la conexion
if (mysqli_connect_errno()) {
	printf("Ups parece que falló en la conexion con la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta_2')) {
	Function ejecutarConsulta_2($sql){ 
global $conexion_2;
$query=$conexion_2->query($sql);
return $query;

	} 

	function ejecutarConsultaSimpleFila_2($sql){
global $conexion_2;

$query=$conexion_2->query($sql);
$row=$query->fetch_assoc();
return $row;
	}
function ejecutarConsulta_retornarID_2($sql){
global $conexion_2;
$query=$conexion_2->query($sql);
return $conexion_2->insert_id;
}

function limpiarCadena_2($str){
global $conexion_2;
$str=mysqli_real_escape_string($conexion_2,trim($str));
return htmlspecialchars($str);
}

}

 ?>