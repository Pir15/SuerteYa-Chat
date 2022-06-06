<?php

require_once("controller/session.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUERTEYA APP - NUEVO PROFESIONAL</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000024">


  </head>
  <body>
  

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
 <div class="d-flex align-items-center left-navbar">
     
 <div class="icon-back"><a href="../index.php"><i class="fas fa-arrow-left"></a></i></div>
   
 <div class="chat-name">NUEVO PROFESIONAL</div>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <i class="fas fa-ellipsis-v"></i>
   </button>

 </div>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
    <li class="nav-item">
        <a class="nav-link"  href="../index.php" ><i class="fas fa-arrow-left"></i> Volver Atras</a>
      </li>

    </ul>
  
  </div>
</nav>

    
<div class="container-fluid contenedor" id="container">
  

    <form id="newUserForm" class="row" action="controller/newUser.php?action=newUser" method="post" enctype="multipart/form-data">
      <div class="mb-3 col-lg-12 d-flex justify-content-center">
        <div class="icon-image-new" id="avatar"></div>
      </div>

      <div class="mb-3 col-lg-12 d-flex justify-content-center">
        <button type="button" id="btnImage" class="col-lg-2 btn btn-success" onclick="getFile()"><i class="fas fa-plus"></i> Añadir Avatar</button>
        <input id="upfile" name="upfile" type="file" value="upload" onchange="sub(this)" style="display:none;" accept="image/png, image/gif, image/jpeg" />
      </div>

    
      <div class="mb-3 col-lg-5">
        <label class="form-label">Pseudonimo/Nombre Visible</label>
        <input type="text" class="form-control" id="nombre" name="name" placeholder="Pseudonimo" require>
      </div>

      <div class="mb-3 col-lg-7">
        <label class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Nombre">
      </div>

      <div class="mb-3 col-lg-6">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" require>
      </div>

      <div class="mb-3 col-lg-3">
        <label class="form-label">Usuario</label>
        <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" require>
      </div>

      <div class="mb-3 col-lg-3">
        <label class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="passwd"  name="passwd" placeholder="Contraseña" require>
      </div>

      <div class="mb-3 col-lg-4">
        <label class="form-label">Telefono</label>
        <input type="text" class="form-control" id="tel"  name="tel" placeholder="Telefono" require>
      </div>

      <div class="mb-3 col-lg-4">
      <label class="form-label">Rol Usuario</label>
        <select class="form-select" id="select_permisos"  name="permisos" aria-label="Default select example">
          
        </select>
      </div>
      <p></p>
      <div class="mb-3 col-lg-12 d-flex justify-content-end">
        <button type="button" id="crearUsuario" class="col-lg-2 btn btn-success"><i class="fas fa-user-plus"></i> Crear Usuario</button>
      </div>
      
    </form>



  
    
</div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body" id="infoLogin">
        ...
      </div>
    </div>
  </div>
</div>

  </body>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/newProfesional.js?v0.00000000000000000000000000000000000000000000000000000007"></script>
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000012"></script>
  <script>
  let per='<?php echo $_SESSION['permisos'] ?>';
</script>
</html> 
