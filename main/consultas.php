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
    <link rel="stylesheet" href="css/css.css?v0.000000000000000000000000000006">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">

    <script>
<?php 

if(isset($_GET['consulta'])){
  ?>
   let idChat='<?php echo $_GET['consulta'] ?>';
   idChat=atob(idChat);
   console.log(idChat);
  <?php
}
?>

</script>
  </head>
  <body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3 d-flex justify-content-between">
    <div class="d-flex align-items-center left-navbar">
      <div class="icon-back"><a href="index.php"><i class="fas fa-arrow-left"></a></i></div>
      <div class="icon-image-2" id="chatLogo"></div>
      <div id="chatName" class="chat-name"></div>
    </div>
    <div class="d-flex align-items-center right-navbar">
    </div>

</nav>

<div class="container-fluid contenedor-consultas mensajes" id="container">
  
</div>

<footer class="mt-auto py-3 bg-light fixed-bottom">
<div class="d-flex align-items-center justify-content-center" id="nCaracteres" style="color:red;">0/150</div>
    <div class="d-flex align-items-center">
    <div id="emoji-button" class="icon-back" style="margin-left: 15px;margin-right: 5px;"><i class="fas fa-smile"></i></div>
      <div class="form-floating m-2" style="width: 10000px">
        <textarea class="form-control" placeholder="Mensaje" id="textInput" style="height: 50px; padding:7px; resize: none;" minlength="300"></textarea>
      </div>
         <div class="icon-back"><a><i class="fas fa-arrow-right" id="sendMensaje"></a></i>
      </div>
    </div>
   
</footer>
    </div>

 





  </body>
  <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/consultasChat.js?v0.00000000000000000000000000000000000000000000000000000000000001"></script>
  <!-- <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000017"></script> -->
</html> 
