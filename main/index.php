
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
    <link rel="stylesheet" href="css/css.css?v0.0000000000000000000000000000030">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">



    <script src="https://kit.fontawesome.com/c098adf723.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    function obtenerToken (to){
      $.post( "controller/token.php",{to:to});
     
    }
    let sessionId='<?php echo $_SESSION['id_user'] ?>'+",";

    <?php 
        if(isset($_GET['lsc']) && $_GET['lsc']!=""){
        ?>
        let lsc='<?php echo $_GET['lsc'] ?>';
        <?php
        }else{
        ?>
            let lsc="0";
        <?php
        }
    ?>
</script>

  


  </head>

  <body oncopy="return false" onpaste="return false" oncut="return false">

  <nav class="navbar  navbar-expand-lg navbar-light bg-light p-3">
    <a class="navbar-brand">  <img src="./img/suerteyaweb2.png" width="100" height="40" class="d-inline-block align-top" ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
      <?php if($_SESSION['permisos']==100){?>
            <!-- <li class="nav-item">
            <a class="nav-link" href="../galand/estado.php"><i class="fas fa-user-check"></i> Estado</a>
            </li> -->
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="../menu_configuracion/index.php"><i class="fas fa-cog"></i> Ajustes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../login/controller/cerrarSesion.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </li>
      </ul>
    </div>
  </nav>

    
<div class="container-fluid p-0" id="container">

<ul class="nav sticky-top  nav-tabs bg-light" id="selectorCanales" role="tablist" style="height: 40px;">

  <?php if($_SESSION['permisos']<100){?>
    <script src="scripts/oficina.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item " role="presentation">
    <button class="nav-link  text-dark " id="oficina-tab" data-bs-toggle="tab" data-bs-target="#oficina" type="button" role="tab" aria-controls="oficina" aria-selected="true">
      <i class="fa-solid fa-building"></i>&nbsp<span class="d-none d-md-inline-block ">Oficina</span></button>
  </li>
  
  <?php }
  /*if($_SESSION['permisos']==0 || $_SESSION['permisos']==7 || $_SESSION['permisos']==11){
  ?>
  <script src="scripts/ventanilla.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark" id="ventanilla-tab" data-bs-toggle="tab" data-bs-target="#ventanilla" type="button" role="tab" aria-controls="ventanilla" aria-selected="false">
    <i class="far fa-window-maximize"></i>&nbsp<div class="d-none d-md-inline-block ">Ventanilla</div></button>
  </li>
  <?php }*/
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==6 || $_SESSION['permisos']==7  || $_SESSION['permisos']==8 || $_SESSION['permisos']==11){
  ?>
    <script src="scripts/centralita.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark" id="centralita-tab" data-bs-toggle="tab" data-bs-target="#centralita" type="button" role="tab" aria-controls="centralita" aria-selected="false">
    <i class="fa-solid fa-phone"></i>&nbsp<div class="d-none d-md-inline-block ">Centralita</div></button>
  </li>
  <?php }
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==5 || $_SESSION['permisos']==6 || $_SESSION['permisos']==11){
  ?>
   <script src="scripts/tecnico.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark" id="tecnico-tab" data-bs-toggle="tab" data-bs-target="#tecnico" type="button" role="tab" aria-controls="tecnico" aria-selected="false">
    <i class="fa-solid fa-laptop"></i>&nbsp<div class="d-none d-md-inline-block ">Tecnico</div></button>
  </li>
  <?php }
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==10){
  ?>
  <script src="scripts/admin.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="false">
    <i class="fa-solid fa-file-contract"></i>&nbsp<div class="d-none d-md-inline-block ">Administración</div></button>
  </li>
  <?php } ?>
  <?php if($_SESSION['permisos']==100){?>
    <script src="scripts/suerteya.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item " role="presentation">
    <button class="nav-link  text-dark " id="suerteya-tab" data-bs-toggle="tab" data-bs-target="#suerteya" type="button" role="tab" aria-controls="suerteya" aria-selected="true">
    <i class="fas fa-headset"></i>&nbsp<div class="d-none d-md-inline-block ">SuerteYa</div></button>
  </li>
  
  <script src="scripts/consultas.js?v0.0000000000000000000000000000000000000000000000000000000000000130"></script>
  <li class="nav-item " role="presentation">
    <button class="nav-link  text-dark " id="consultas-tab" data-bs-toggle="tab" data-bs-target="#consultas" type="button" role="tab" aria-controls="consultas" aria-selected="true">
    <i class="fas fa-comment"></i>&nbsp<div class="d-none d-md-inline-block ">Consultas</div></button>
  </li>
  <?php }?> 
  <!-- <li class="nav-item" role="presentation">
    <button class="nav-link text-dark" id="gerencia-tab" data-bs-toggle="tab" data-bs-target="#gerencia" type="button" role="tab" aria-controls="gerencia" aria-selected="false">
    <i class="fa-solid fa-user-tie"></i> Gerencia</button>
  </li> -->
  
  
</ul>

<div class="tab-content" id="myTabContent">
  
<?php if($_SESSION['permisos']<100){?>
  <a class="btn-flotante" id="contactosBtn"><i class="fas fa-address-book"></i></a>
  <div class="tab-pane fade " id="oficina" role="tabpanel" aria-labelledby="oficina-tab">
    <div class="chat-container m-3" id="chatOficina">
    </div> 
  </div>
  <?php }
 /* if($_SESSION['permisos']==0 || $_SESSION['permisos']==7 || $_SESSION['permisos']==11){
  ?>
  <div class="tab-pane fade" id="ventanilla" role="tabpanel" aria-labelledby="ventanilla-tab">  
    <div class="chat-container m-3" id="chatVentanilla">
    </div> 
  </div>
  <?php }*/
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==6 || $_SESSION['permisos']==7  || $_SESSION['permisos']==8 || $_SESSION['permisos']==11){
  ?>
  <div class="tab-pane fade" id="centralita" role="tabpanel" aria-labelledby="centralita-tab">  
    <div class="chat-container m-3" id="chatCentralita">
    </div> 
  </div>
  <?php }
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==5 || $_SESSION['permisos']==6 || $_SESSION['permisos']==11){
  ?>
  <div class="tab-pane fade" id="tecnico" role="tabpanel" aria-labelledby="tecnico-tab">  
    <div class="chat-container m-3" id="chatTecnico">
    </div> 
  </div>
  <?php }
  if($_SESSION['permisos']==0 || $_SESSION['permisos']==10){
  ?>
  <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">  
    <div class="chat-container m-3" id="chatAdmin">
    </div> 
  </div>

  <!-- <div class="tab-pane fade" id="gerencia" role="tabpanel" aria-labelledby="gerencia-tab">  
    <div class="chat-container m-3" id="chatGerencia">
    </div> 
  </div> -->
  <?php } ?>
  <?php if($_SESSION['permisos']==100){?>
  <div class="tab-pane fade" id="suerteya" role="tabpanel" aria-labelledby="suerteya-tab">
    <div class="chat-container m-3" id="chatOficina">
    </div> 
    <a class="btn-flotante" id="contactosBtn"><i class="fas fa-address-book"></i></a>
  </div>

  <div class="tab-pane fade" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">  
    <div class="chat-container m-3" id="chatConsultas">
    </div> 
  </div>

  <?php } ?>
  
  <!-- <div class="tab-pane fade" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">  
    <div class="chat-container m-3" id="chatConsultas">
    </div> 
  </div> -->

</div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="infoChat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
     <div class="modal-body d-flex flex-column justify-content-center align-items-center text-center">
       <div id="modalMain" class="d-flex flex-column justify-content-center align-items-center text-center">
          <div id="avatar" class='icon-image-new d-flex align-items-center justify-content-center'></div></p>
          <b><h4 id="Nombre">Nombre Chat</h4></b>
          <div class="row d-flex justify-content-center">
            <p style="display: none" id="usuarios" class=" m-2 col-md-11"></p>
          <button type="button" class="btn btn-warning m-2 col-md-11"  id="anadirUser" style="display: none"><i class="fas fa-glasses"></i> Marcar como Leido </button>
          <!-- <button type="button" class="btn btn-secondary m-2 col-md-11"  id="anadirAdmin" style="display: none"><i class="fas fa-user-tie"></i> Añadir Administrador</button>
          <button type="button" class="btn btn-info text-white m-2 col-md-11" id="editGroup" style="display: none"><i class="fas fa-pen"></i> Editar grupo</button>
          <button type="button" class="btn btn-danger m-2 col-md-11" id="salirGrupo" style="display: none"><i class="fas fa-sign-out-alt"></i> Salir del Grupo</button> -->
          </div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="close btn btn-danger" data-dismiss="modal">Cerrar</button> 
     </div>
   </div>
  </div>
</div>


  
  </body>
  
  <script src="scripts/index.js?v0.0000000000000000000000000000000000000000000000000000000000000119"></script>
  <script src="../node_modules/push.js/bin/push.min.js"></script>
  <script src="scripts/notificaciones.js?v0.0000000000000000000000000000000000000000000000000000000000000113"></script>
</h