<?php

session_start();
require_once '../model/User.php';

$usuario=new User();

if($_GET["action"]=="editUser"){
    $id=$_POST["id"];
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
        $result=$usuario->changeAvatar($id,$avatar);
    }

    if($passwd!=""){
        $result=$usuario->changePasswd($id,$passwd);
    }

    $result=$usuario->editUser($id,$name,$apellidos,$email,$user,$tel,$permisos);

    header('Location:' . getenv('HTTP_REFERER'));


}



  




?>