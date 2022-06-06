<?php

require_once("controller/session.php");

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light only">
    <title>SUERTEYA APP - CHAT</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000040">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
<?php 

if(isset($_GET['idChat'])){
  ?>
   let idChat='<?php echo $_GET['idChat'] ?>';
   idChat=atob(idChat);
   let idUser=0;
  <?php
}else{
  ?>
  let idChat=0;
  let idUser='<?php echo $_GET['idUser'] ?>';
  idUser=atob(idUser);
<?php
}
if(isset($_GET['msg'])){
  ?>
  let msg='<?php echo $_GET['msg'] ?>';


 <?php
}else{
?>
let msg=0;
<?php
}
if(isset($_GET['rusr'])){
  ?>
let globalUser='<?php echo $_GET['rusr'] ?>';
//globalUser=atob(globalUser);
<?php
}else{
?>
let globalUser=0;
<?php 
}
?>

</script>
  </head>
  <body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
 
  <div class="d-flex align-items-center left-navbar">
      
  <div class="icon-back"><a href="index.php?lsc=<?php echo $_GET['rusr']?>"><i class="fas fa-arrow-left"></a></i></div>
    
  <div class="icon-image-2" id="chatLogo"></div>
  <div id="chatName" class="chat-name"></div>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-ellipsis-v"></i>
    </button>

  </div>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
    <li class="nav-item">
       <a class="nav-link" type="button"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-info-circle"></i> Info del Chat</a>
    </li>
    <li class="nav-item">
        <!-- <a class="nav-link" href="">Contactos</a> -->
      </li>
    </ul>
  
  </div>
</nav>

<div class="container-fluid contenedor-chat mensajes" id="container">
  
</div>

<footer class="mt-auto py-1 bg-light fixed-bottom">
    <div class="d-flex align-items-center m-2 inputMensaje">


<div id="emoji-button" class="icon-back" style="margin-left: 15px;margin-right: 5px;"><i class="fas fa-smile"></i></div>
      <div class="form-floating m-2" style="width: 10000px">
        <textarea class="form-control" placeholder="Mensaje" id="textInput" style="height: 40px; padding:7px; resize: none;"></textarea>
      </div>
<div class="icon-back"><a><i class="fas fa-arrow-right" id="sendMensaje"></a></i></div>
    </div>
</footer>
    </div>

   <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
     <div class="modal-body d-flex flex-column justify-content-center align-items-center text-center">
       <div id="modalMain" class="d-flex flex-column justify-content-center align-items-center text-center">
          <div id="avatar" class='icon-image-new d-flex align-items-center justify-content-center'></div></p>
          <b><h4 id="Nombre">Nombre Chat</h4></b>
          <div class="row d-flex justify-content-center">
            <p style="display: none" id="usuarios" class=" m-2 col-md-11"></p>
          <button type="button" class="btn btn-success m-2 col-md-11"  id="anadirUser" style="display: none"><i class="fas fa-user-plus"></i> Añadir usuario</button>
          <button type="button" class="btn btn-secondary m-2 col-md-11"  id="anadirAdmin" style="display: none"><i class="fas fa-user-tie"></i> Añadir Administrador</button>
          <button type="button" class="btn btn-info text-white m-2 col-md-11" id="editGroup" style="display: none"><i class="fas fa-pen"></i> Editar grupo</button>
          <button type="button" class="btn btn-danger m-2 col-md-11" id="salirGrupo" style="display: none"><i class="fas fa-sign-out-alt"></i> Salir del Grupo</button>
          </div>
       </div>
       <div id="modalAddUser" style="display: none">
            <h5>Añadir Usuario</h5>
            <select class="form-select" multiple aria-label="multiple select example" id="userList" size="6">
            </select>
            <br>
            <button type="button" class="close btn btn-success m-2" id="insertNewUser">Añadir</button> 
       </div>
       <div id="modalAddAdmin" style="display: none">
            <h5>Añadir Administradores</h5>
            <select class="form-select" multiple aria-label="multiple select example" id="userListChat" size="6">
            </select>
            <br>
            <button type="button" class="close btn btn-success m-2" id="insertNewAdmin">Añadir</button> 
       </div>
       <div id="modalChangeGroup" style="display: none">
            <h5>Editar Grupo</h5>
            <input type="text" class="form-control m-2" id="nameInput" placeholder="Nombre" name="nombre">
            <!-- <button type="button" id="btnImage" class="btn btn-warning" onclick="getFile()">Editar Imagen</button></p> -->
            <button type="button" class="close btn btn-success m-2"  id="updateChat">Modificar</button> 
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="close btn btn-danger" data-dismiss="modal">Cerrar</button> 
     </div>
   </div>
  </div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
     <div class="modal-body d-flex flex-column justify-content-center align-items-center">
       <div id="mensajeModalDiv" class="d-flex flex-column justify-content-center align-items-center"></div><p></p>
       <div class="row d-flex justify-content-center">

          <button type="button" class="btn btn-success m-2 col-md-11"  id="ReenviarMensaje"  style="display: none" ><i class="fa-solid fa-share-from-square"></i> Reenviar Mensaje</button>
          <button type="button" class="btn btn-info text-white m-2 col-md-11"  id="copiarMensaje"  ><i class="fa-solid fa-copy"></i> Copiar Mensaje</button>
          <button type="button" class="btn btn-danger m-2 col-md-11" id="borrarMensaje" style="display: none" ><i class="fa-solid fa-eraser"></i> Borrar Mensaje</button>
          
       </div>
       <em class="text-center" id="mensajeCopiadoOk" style="display: none">Mensaje Copiado</em>
     </div>
     <div class="modal-footer">
      <button type="button" class="close btn btn-danger" data-dismiss="modal" onclick="">Cerrar</button> 
     </div>
   </div>
  </div>
</div>

  </body>
  <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/chat.js?v0.00000000000000000000000000000000000000055"></script>
  <script src="scripts/newGroup.js?v0.00000000000000000000000000000000000000039"></script>
  <script src="scripts/notificaciones.js?v0.000000000"></script>