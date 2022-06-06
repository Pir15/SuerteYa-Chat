<?php

require_once("controller/session.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUERTEYA APP - ADMINISTRAR PROFESIONALES</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000024">


  </head>
  <body>
  

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
 <div class="d-flex align-items-center left-navbar">
     
 <div class="icon-back"><a href="index.php"><i class="fas fa-arrow-left"></a></i></div>
   
 <div class="chat-name">PROFESIONALES</div>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <i class="fas fa-ellipsis-v"></i>
   </button>

 </div>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
    <li class="nav-item">
        <a class="nav-link"  href="index.php" ><i class="fas fa-arrow-left"></i> Volver Atras</a>
      </li>

    </ul>
  
  </div>
</nav>

    
<div class="container-fluid contenedor" id="container">
<table id="table" class="table-striped table-light"
data-toolbar=".toolbar"
  data-virtual-scroll="true"
  data-search="true"
  data-pagination="true"
  data-page-size="10"
  data-search-accent-neutralise="true"
  
  class="table table-striped">
  <thead>
    <tr>
          <th data-field="idUser" data-sortable="true">ID</th>
          <th data-field="nombre" data-sortable="true">Nombre</th>
          <th data-field="usuario" data-sortable="true">Usuario</th>
          <th data-field="avatar">Avatar</th>
          <th data-field="edit">Editar</th>
          <th data-field="estado" data-sortable="true" >Estado</th>
          <th data-field="delete">Borrar</th>
    </tr>
  </thead>
</table>
</div>
    </div>

    <div class="modal fade" id="exampleModalBaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body" >
        ¿Está seguro de que quiere dar de alta a este usuario?
      </div>
    </div>
  </div>
</div>

    <div class="modal fade" id="exampleModalBaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body" >
        ¿Está seguro de que quiere dar de baja a este usuario?
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body" >
      ¿Está seguro de que quiere borrar este usuario?
      </div>
    </div>
  </div>
</div>



  </body>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  

 
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/adminProfesional.js?v0.0000000000000000000000000000000000000000009"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000012"></script>
  <script>
  let per='<?php echo $_SESSION['permisos'] ?>';
</script>
</html> 
