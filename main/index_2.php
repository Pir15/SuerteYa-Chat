
<?php

require_once("controller/session.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUERTEYA APP - CHAT</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000022">


  </head>
  <body>

  <nav class="navbar  sticky-top navbar-expand-lg navbar-light bg-light p-3">
    
  <a class="navbar-brand">  <img src="./img/suerteyaweb2.png" width="100" height="40" class="d-inline-block align-top" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-ellipsis-v"></i>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
    
      <li class="nav-item">
        <a class="nav-link" href="contactos.php"><i class="fas fa-address-book"></i> Contactos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../menu_configuracion/index.php"><i class="fas fa-cog"></i> Ajustes</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../login/controller/cerrarSesion.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
      </li>
      
    </ul>
  
  </div>
</nav>

    
<div class="container-fluid contenedor" id="container">

    <div class="chat-container" id="chatContainer">
      <div class="div-load">
        <div class="spinner-border text-light" style="width: 6rem; height: 6rem;" role="status">
        </div>
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
  <script src="scripts/chatList.js?v0.00000000000000000000000000000000000000000000000037"></script>
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000017"></script>
<script>
  
</script>
  
</html>
  

