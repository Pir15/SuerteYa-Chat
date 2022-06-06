$(document).ready(function(){
  function listarContactos(){
    $.post( "controller/contactos.php",{action:"listarContactos"},
    function(data) { 
    data=JSON.parse(data);
    quitarScrollCarga();
    document.querySelector("#contactosContainer").innerHTML="";
      if(per<100){
    let newGrupoContainer=document.createElement("p");
    newGrupoContainer.id="newGroup"
    newGrupoContainer.innerHTML='<div class="chat-card" id="new">'+
        '<div class="icon-image-group">+</div>'+
        '<div class="chat-body" ><div><b>CREAR GRUPO</b></div></div>';
        newGrupoContainer.addEventListener("click",function(){
         
          $('#exampleModal').modal('show');
         })
      document.querySelector("#contactosContainer").appendChild(newGrupoContainer);
        }
    
    

    for(let contacto of data){
    let contactoContainer=document.createElement("p");
      contactoContainer.textContent=contacto[1];
      if(contacto[2]<100){
        contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
        '<div class="icon-image-ofi">'+contacto[1].charAt(0)+'</div>'+
        '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      }

      if(contacto[2]>=100 && contacto[2]<200){
        contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
        '<div class="icon-image-pro">'+contacto[1].charAt(0)+'</div>'+
        '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      }

      if(contacto[2]>=200 && contacto[2]<300){
        contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
        '<div class="icon-image-cli">'+contacto[1].charAt(0)+'</div>'+
        '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      }
      
       
        if(contacto[3]==0){
          contactoContainer.addEventListener("click",function(){
            window.open("chat.php?idUser="+contacto[0],"_self");
           });
        }else{
          contactoContainer.addEventListener("click",function(){
            window.open("chat.php?idChat="+contacto[3],"_self");
           });
        }

        
      document.querySelector("#contactosContainer").appendChild(contactoContainer);
    }
   
    }
   ); 

  
  }

  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  init();


  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){
    setInterval(function(){recargar()},1000);
  }

  //FUNCION QUE CARGA EL CODIGO QUE SE EJECUTARÁ EN BUCLE
  function recargar() {
    listarContactos(); 
 }

 //FUNCION PARA QUITAR LA PANTALLA DE CARGA
 function quitarScrollCarga(){
  if(document.querySelector("#container").style.display!="block"){
    window.scrollTo(0, 0);
    document.querySelector("#container").style.display="block";
  }
  
 
 
 }




});





