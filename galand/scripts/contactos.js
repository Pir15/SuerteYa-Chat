$(document).ready(function(){
  
  let title=document.querySelector("#contactosName");
  title.textContent=title.textContent+" "+canal.toUpperCase();
  switch (canal) {
    case "oficina":
       stringCanal="";
        break;
    case "ventanilla":
        stringCanal="&rusr=18";
        break;
    case "centralita":
      stringCanal="&rusr=19";
        break;
    case "tecnico":
      stringCanal="&rusr=21";
        break;
    case "admin":
      stringCanal="&rusr=187";
        break;
    case "suerteya":
      stringCanal="";
        break;
}


  function listarContactos(){
    $.post( "controller/contactos.php",{action:"listarContactos",canal:canal},
    function(data) { 
    data=JSON.parse(data);
    quitarScrollCarga();
    document.querySelector("#contactosContainer").innerHTML="";
      if(canal=="oficina"){
    let newGrupoContainer=document.createElement("p");
    newGrupoContainer.id="newGroup"
    newGrupoContainer.innerHTML='<div class="chat-card" id="new">'+
        '<div class="icon-image">+</div>'+
        '<div class="chat-body" ><div><b>CREAR GRUPO</b></div></div>';
        newGrupoContainer.addEventListener("click",function(){
         
          $('#exampleModal').modal('show');
         })
      document.querySelector("#contactosContainer").appendChild(newGrupoContainer);
        }
    
    

    for(let contacto of data){
    let contactoContainer=document.createElement("p");
      contactoContainer.textContent=contacto[1];
      if(contacto[4]=="" || contacto[4]==null){
        contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
      '<div class="icon-image">'+contacto[1].charAt(0)+'</div>'+
      '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      }else{
        contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
      '<div class="icon-image" style="background-image:url(../img/avatar/'+contacto[4]+');background-color:white;"></div>'+
      '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      }

      

      // if(contacto[2]<100){
      //   contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
      //   '<div class="icon-image-ofi">'+contacto[1].charAt(0)+'</div>'+
      //   '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      // }

      // if(contacto[2]>=100 && contacto[2]<200){
      //   contactoContainer.innerHTML='<div class="chat-card" id="'+contacto[0]+'">'+
      //   '<div class="icon-image-pro">'+contacto[1].charAt(0)+'</div>'+
      //   '<div class="chat-body"><div><b>'+contacto[1]+'</b></div></div>';
      // }

      // if(contacto[2]>=200 && contacto[2]<300){
      //  
      // }
      
       
        if(contacto[3]==0){
          contactoContainer.addEventListener("click",function(){
            window.open("chat.php?idUser="+btoa(contacto[0])+stringCanal,"_self");
           });
        }else{
          contactoContainer.addEventListener("click",function(){
            
            window.open("chat.php?idChat="+btoa(contacto[3])+stringCanal,"_self");
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
    listarContactos(); 
    setInterval(function(){recargar()},10000);
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





