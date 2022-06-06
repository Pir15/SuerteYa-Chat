<?php

require_once("controller/session.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUERTEYA APP - AJUSTES</title>
    <link rel="icon" href="img/ico.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000024">


  </head>
  <body>
  

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
 <div class="d-flex align-items-center left-navbar">
     
 <div class="icon-back"><a href="../index.php"><i class="fas fa-arrow-left"></a></i></div>
   
 <div class="chat-name">AJUSTES</div>

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

<div class="row d-flex justify-content-center align-items-center">
  
<div class="col-lg-4">
<a class="card text-white bg-success mb-3 m-2 text-decoration-none" href="myAcount.php">
  <div class="card-body">
   <div class="menu-option-text"><i class="fas fa-user"></i> Mi Cuenta</div>
  </div>
</a>
</diV>


<?php 
if($_SESSION["permisos"]<=5){
?>

<div class="col-lg-4">
<a class="card text-white bg-primary mb-3 m-2 2 text-decoration-none" href="newUser.php" >
  <div class="card-body">
   <div class="menu-option-text"><i class="fas fa-user-plus"></i> Crear Usuario</div>
  </div>
</a>
</div>


<div class="col-lg-4">
<a class="card text-white bg-secondary mb-3 m-2 2 text-decoration-none" href="adminUsers.php" >
  <div class="card-body">
   <div class="menu-option-text"><i class="fas fa-users-cog"></i> Administrar Usuarios</div>
  </div>
</a>
</div>


<?php 
}

if($_SESSION["permisos"]<=70 && $_SESSION["permisos"]>5){
  ?>
  
  <div class="col-lg-4">
  <a class="card text-white bg-primary mb-3 m-2 2 text-decoration-none" href="newProfesional.php" >
    <div class="card-body">
     <div class="menu-option-text"><i class="fas fa-user-plus"></i> Añadir Profesional</div>
    </div>
  </a>
  </div>
  
  
  <div class="col-lg-4">
  <a class="card text-white bg-secondary mb-3 m-2 2 text-decoration-none" href="adminProfesional.php" >
    <div class="card-body">
     <div class="menu-option-text"><i class="fas fa-users-cog"></i> Administrar Profesionales</div>
    </div>
  </a>
  </div>
  
  
  <?php 
  }
?>

<div class="col-lg-4">
<div class="card text-white bg-info mb-3 m-2" >
<div class="card-body">
   <div class="menu-option-text"><i class="fas fa-question"></i> Ayuda</div>
  </div>
</div>
</diV>


<div class="col-lg-4">
<a class="card text-white bg-danger mb-3 m-2 text-decoration-none" href="../login/controller/cerrarSesion.php">
<div class="card-body">
   <div class="menu-option-text" href="../login/controller/cerrarSesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</div>
  </div>
</a>
</diV>




</div>
    
</div>




  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title display-6" id="exampleModalLabel">Nuevo Grupo</h5>
        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close" id="close2">
          <span aria-hidden="true"><i class="fas fa-window-close"></i></span>
        </button>
      </div>
      <div class="modal-body">
          <form>
   
      <div class="form-group">
        <label for="">Nombre de Grupo</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nombre">
      </div>
      <p></p>
      <div class="form-group">
        <label for="">Integrantes del grupo</label>
        <select multiple  class="form-control" id="userList" size="10">
        
        </select>
      </div>
      <br>
      <label class="text-danger" id="groupAlert" style="display: none;">Debe añadir nombre y usuarios al grupo</label>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="close1"><i class="fas fa-window-close"></i> Cerrar</button>
        <button type="button" class="btn btn-success" id="crearGrupo"><i class="fas fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div> -->




    

 

    </div>
  </body>
  <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/js.js"></script>
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000012"></script>
  <script>
  let per='<?php echo $_SESSION['permisos'] ?>';
</script>
</html> 
