<?php

require_once("controller/session.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light only">
    <title>SUERTEYA APP - CONTACTOS</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000056">


  </head>
  <body>
  

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
 <div class="d-flex align-items-center left-navbar">
     
 <div class="icon-back"><a href="../index.php"><i class="fas fa-arrow-left"></a></i></div>
   
 <div class="chat-name" id="contactosName">CONTACTOS</div>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <i class="fas fa-ellipsis-v"></i>
   </button>

 </div>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
    <li class="nav-item">
        <a class="nav-link" onclick="location.reload();"><i class="fas fa-redo-alt"></i> Actualizar</a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" href=""><i class="fas fa-question"></i> Ayuda</a>
      </li> -->

      <li class="nav-item">
        <!-- <a class="nav-link" href="../login/controller/cerrarSesion.php">Cerrar Sesión</a> -->
      </li>
      
    </ul>
  
  </div>
</nav>

    
<div class="container-fluid contenedor" id="container">


    <div class="contactos-container m-2" id="contactosContainer">
      <div class="div-load">
        <div class="spinner-border text-light" style="width: 6rem; height: 6rem;" role="status">
        </div>
      </div>
    </div>
</div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <form action="controller/contactos.php?action=newGroup" method="post" enctype="multipart/form-data" id="newGroupForm">

          <input id="id" name="id" type="hidden">
      <div class="mb-3 col-lg-12 d-flex justify-content-center">
        <div class="icon-image-new" id="avatar"></div>
      </div>

      <div class="mb-3 col-lg-12 d-flex justify-content-center">
        <button type="button" id="btnImage" class="col-lg-6 btn btn-success" onclick="getFile()"><i class="fas fa-plus"></i> Añadir Imagen</button>
        <input id="upfile" name="upfile" type="file" value="upload" onchange="sub(this)" style="display:none;" accept="image/png, image/gif, image/jpeg" />
      </div>
   
      <div class="form-group">
        <label for="">Nombre de Grupo</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nombre" name="nombre"> 
      </div>
      <p></p>
      <div class="form-group">
        <label for="">Integrantes del grupo</label>
        <select multiple  class="form-control" id="userList" size="10" name="users">
        
        </select>
      </div>
      <br>
      <label class="text-danger" id="groupAlert" style="display: none;">Debe añadir nombre y usuarios al grupo</label>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="close1">Cerrar</button>
        <button type="button" class="btn btn-success" id="crearGrupo">Crear</button>
      </div>
    </div>
  </div>
</div>




<?php
if(isset($_GET['rusr'])){
  ?>
  <script>
let globalUser='<?php echo $_GET['rusr'] ?>';
</script>

<?php
}  
?>

 

    </div>
  </body>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/js.js"></script>
  <script src="scripts/contactos.js?v0.00000000000000000000000000000000000000000000029"></script>
  <script src="scripts/newGroup.js?v0.00000000000000000000000000000000000000000000007"></script>
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000018"></script>
  <script>
  let per='<?php echo $_SESSION['permisos'] ?>';
  <?php
  if(isset($_GET['chn'])){
    ?>
  let canal='<?php echo $_GET['chn'] ?>';
  canal=atob(canal)
  <?php
  }  
?>
</script>
</html> 
