$(document).ready(function(){

   let arrayChats=new Array();
  

  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  init(); 




//FUNCION QUE LISTA LOS CHATS DEL USUARIO
  function listarChat() {
    $.post( "controller/chat.php",{action:"listarChat"},
    function(data) {
      
      data=JSON.parse(data);
      if(data.length>0){
      for(let i=0;i<data.length;i++) {
        let chatObjet=new Chat(data[i][0],data[i][2],data[i][4],data[i][3],data[i][5],data[i][6],data[i][7],data[i][1],data[i][8]);
        arrayChats.push(chatObjet);
      }
    }else{
      document.querySelector("#chatContainer").innerHTML="<div class='d-flex flex-column'><div class='display-6 text-center'>Todavía no hay mensajes. "+
      "Sé el primero en conversar.</div><br><a href='contactos.php' type='button' class='btn btn-outline-success btn-light'><i class='fas fa-address-book'></i> Contactos</a></div>";
    }
      
    },
   ); 
  }

  


  

  //FUNCION QUE DIBUJA LOS CHAT EN PANTALLA
  function dibujarChat(){

    arrayText=new Array();
    arrayNoText=new Array();

    for(let chat of arrayChats){
      
      if(chat.getDateMensaje==""){
        arrayNoText.push(chat)
      }else{
        arrayText.push(chat)
      }
    }
    
    arrayText.sort(function (a, b) {
        if (a.getDateMensaje < b.getDateMensaje) {
          return 1;
        }
        if (a.getDateMensaje > b.getDateMensaje) {
          return -1;
        }
        
        return 0;
    });

    arrayNoText.sort(function (a, b) {
      if (a.getDateChat < b.getDateChat) {
        return 1;
      }
      if (a.getDateChat > b.getDateChat) {
        return -1;
      }
      
      return 0;
  });

  arrayChats=arrayText.concat(arrayNoText)
  
    let nMensajesTotales=0;

    if(arrayChats.length>0){
      quitarScrollCarga();
      document.querySelector("#chatContainer").innerHTML="";
     
      for(let i=0;i<arrayChats.length;i++){
        let chatContainer=document.createElement("p");
        let fecha=vistaFecha(arrayChats[i].getDateMensaje)
        let nMensajes=arrayChats[i].getSinLeer;

        let HTMLcard='<div class="chat-card" id="'+arrayChats[i].getId+'">'


        if(arrayChats[i].getTipoChat=="INDIVIDUAL"){

          if(arrayChats[i].getPermisos<100){
            HTMLcard+='<div class="icon-image-ofi">'+arrayChats[i].getNombre.charAt(0)+'</div>'+
          '<div class="chat-body"><div><b>'+arrayChats[i].getNombre+'</b><i class="date-label"> '+fecha+'</i></div>';
          }

          if(arrayChats[i].getPermisos<200 && arrayChats[i].getPermisos>=100){
            HTMLcard+='<div class="icon-image-pro">'+arrayChats[i].getNombre.charAt(0)+'</div>'+
          '<div class="chat-body"><div><b>'+arrayChats[i].getNombre+'</b><i class="date-label"> '+fecha+'</i></div>';
          }

          if(arrayChats[i].getPermisos<300 && arrayChats[i].getPermisos>=200){
            HTMLcard+='<div class="icon-image-cli">'+arrayChats[i].getNombre.charAt(0)+'</div>'+
          '<div class="chat-body"><div><b>'+arrayChats[i].getNombre+'</b><i class="date-label"> '+fecha+'</i></div>';
          }
          
        }

        if(arrayChats[i].getTipoChat=="GRUPO"){
          HTMLcard+='<div class="icon-image-group">'+arrayChats[i].getNombre.charAt(0)+'</div>'+
          '<div class="chat-body"><div><b>'+arrayChats[i].getNombre+'</b><i class="date-label"> '+fecha+'</i></div>';
        }

      
       

        
        if(arrayChats[i].getMensaje!=""){
         
             HTMLcard+='<div> '+arrayChats[i].getUser+': '+arrayChats[i].getMensaje+'</div></div>';
      
           
        }
 
        if(nMensajes>0){
          HTMLcard+='<div  class="icon-mensajes m-1" id="nMensajes">'+arrayChats[i].getSinLeer+'</div>';
          nMensajesTotales+=arrayChats[i].getSinLeer

        }
        chatContainer.innerHTML=HTMLcard+"</div>";

      document.querySelector("#chatContainer").appendChild(chatContainer);
     
      
      }

       arrayChats.length=0;
    }


    //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
    function vistaFecha(fecha) {
      if(fecha==""){
        return "";
      }else{
        let ahora = new Date().getDate();
      fecha=new Date(fecha);
   
      if(ahora==fecha.getDate()){
        return ('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
       }

      if(ahora==fecha.getDate()+1){
       return "Ayer" ;
      }
    
      if(ahora>=fecha.getDate()+2){
        return ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2);
       }

    }
  }
    
  }
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){
    listarChat()  
    dibujarChat()
    let chats=document.querySelectorAll(".chat-card")
    for(let i=0;i<chats.length;i++){
      chats[i].addEventListener("click",function(){
        window.open("chat.php?idChat="+chats[i].id,"_self");
      })
    }
    setInterval(function(){recargar()},1000);
  }

  //FUNCION QUE CARGA EL CODIGO QUE SE EJECUTARÁ EN BUCLE
  function recargar() {
    listarChat()  
      dibujarChat()
      let chats=document.querySelectorAll(".chat-card")
      for(let i=0;i<chats.length;i++){
        chats[i].addEventListener("click",function(){
          window.open("chat.php?idChat="+chats[i].id,"_self");
        })
      }

      if( typeof Android!== 'undefined'){
        Android.closeNotifications();
      }
      
 }

 //FUNCION PARA QUITAR LA PANTALLA DE CARGA
 function quitarScrollCarga(){
  if(document.querySelector("#container").style.display!="block"){
    window.scrollTo(0, 0);
  }
  document.querySelector("#container").style.display="block";
 }
});


//CLASE CHAT PARA USARLA EN JS
class Chat {
  constructor(id,nombre,text,dateChat,dateMensaje,sinLeer,user,tipoChat,permisos) {
    this.id=id,
    this.nombre=nombre,
    this.text=text,
    this.dateChat=dateChat,
    this.dateMensaje=dateMensaje,
    this.sinLeer=sinLeer,
    this.user=user
    this.tipoChat=tipoChat
    this.permisos=permisos
  }

  get getId() { return this.id}

  get getNombre() { return this.nombre}

  get getMensaje() { return this.text}

  get getDateChat() { return this.dateChat}

  get getDateMensaje() { return this.dateMensaje}

  get getSinLeer() { return this.sinLeer}

  get getUser() { return this.user}

  get getTipoChat() { return this.tipoChat}

  get getPermisos() { return this.permisos}


}
