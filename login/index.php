<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light only">
    <title>SUERTEYA APP - LOGIN</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.000000000000000000000000000000000000000000002">


  </head>
  <body>
    <div class="container-fluid contenedor">

<!-- Form -->
<form class="form-login col-sm-3">
  <div class="mb-3">
    <img src="img/suerteyaweb2.png" class="img-fluid"><p></p>
    <label for="exampleInputEmail1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="user" required><p></p>
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="passwd" required>
  </div>
 
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input"  id="mantenerSesion">
    <label class="form-check-label" for="exampleCheck1">Mantener sesión abierta</label>
  </div> -->

  <button type="button" class="btn btn-success" id="acceder" >Acceder</button><p></p>
 
  <!-- <div id="emailHelp" class="form-text align-items-center">¿Aún no tienes Cuenta? <p></p>
  <button type="button" class="btn btn-primary">Registrarse</button> </div> -->
</form>


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

 

    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/js.js?v=0000000001"></script>
</html> 
