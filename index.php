<?php 
session_start();
if(isset($_SESSION["id_user"]) ){

    header('location: main/index.php'); 
    
}else{
    if(!isset($_SESSION["id_user"]) && isset($_COOKIE['id_user']) ){
        $_SESSION["id_user"]=$_COOKIE['id_user'];
        header('location: main/index.php');
    }else{
        header('location: login/index.php');  
    }
        
}
 
 ?>


