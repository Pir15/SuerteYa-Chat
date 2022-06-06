<?php

session_start();
require_once '../model/User.php';

$usuario=new User();

if($_GET["action"]=="newUser"){

    $name=$_POST["name"];
    $apellidos=$_POST["apellidos"];
    $email=$_POST["email"];
    $user=$_POST["user"];
    $passwd=$_POST["passwd"];
    $tel=$_POST["tel"];
    $permisos=$_POST["permisos"];

   $date=date("Ymd");

    if(isset($_FILES["upfile"]["tmp_name"]) && $_FILES["upfile"]["name"]!=""){
        $dir = "../../img/avatar/";
        move_uploaded_file($_FILES["upfile"]["tmp_name"], $dir. $date."_".$_FILES["upfile"]["name"]);
        $avatar= $date."_".$_FILES["upfile"]["name"];
    }else{
        $avatar="";
    }

    echo $result=$usuario->createUser($name,$apellidos,$email,$user,$passwd,$tel,$permisos,$avatar);

    header('Location: ../adminUsers.php');


}



  




?>