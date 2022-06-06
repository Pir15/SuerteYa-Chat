$(document).ready(function(){

  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  init(); 

 let arrayChats=new Array();


//FUNCION QUE LISTA LOS CHATS DEL USUARIO
  function listarChat() {
    $.post( "controller/chat.php",{action:"listar"},
    function(data) {
      data=JSON.parse(data);
      if(data.length>0){
      for(let i=0;i<data.length;i++) {
       dataChat(data[i]);
      }
    }else{
      document.querySelector("#chatContainer").innerHTML="NO HAY CHATS";
    }
      
    },
   ); 
  }

  
  //FUNCION QUE NOS OBTIENE LOS DATOS DE LOS CHAT
  function dataChat(chat) {
    $.post( "controller/chat.php",{action:"chatData",id_chat:chat[0],chatname:chat[2]},
    function(data) {
      data=JSON.parse(data);
     

      if(chat[2]==""){
        let chatObjet=new Chat(chat[0],data[0],data[1],chat[3],data[2],data[3],data[4]);
        arrayChats.push(chatObjet);
      }else{
        let chatObjet=new Chat(chat[0],chat[2],data[1],chat[3],data[2],data[3],data[4]);
       
        arrayChats.push(chatObjet);
      }
    }
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
  
    
    if(arrayChats.length>0){
      quitarScrollCarga();
      document.querySelector("#chatContainer").innerHTML="";
      for(let i=0;i<arrayChats.length;i++){
        let chatContainer=document.createElement("p");
        let fecha=vistaFecha(arrayChats[i].getDateMensaje)
        let nMensajes=arrayChats[i].getSinLeer;

        let HTMLcard='<div class="chat-card" id="'+arrayChats[i].getId+'">'+
        '<div class="icon-image">'+arrayChats[i].getNombre.charAt(0)+'</div>'+
        '<div class="chat-body"><div><b>'+arrayChats[i].getNombre+'</b><i> '+fecha+'</i></div>';

        if(arrayChats[i].getMensaje!=""){
           HTMLcard+='<div> '+arrayChats[i].getUser+': '+arrayChats[i].getMensaje+'</div></div>';
        }
 
        if(nMensajes>0){
          HTMLcard+='<div  class="icon-mensajes" id="nMensajes">'+arrayChats[i].getSinLeer+'</div>';
        }
        chatContainer.innerHTML=HTMLcard;

      document.querySelector("#chatContainer").appendChild(chatContainer);
      }
    }


    //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
    function vistaFecha(fecha) {
      if(fecha==""){
        return "";
      }else{
      let ahora = new Date().getTime();
      fecha=new Date(fecha.replace(/-/g, "/"));
      diferecia=ahora-fecha.getTime();
      if(diferecia<86400000){
       return fecha.getHours() + ':' + fecha.getMinutes();
       }

      if(diferecia>=86400000 && diferecia<172800000){
       return "Ayer" ;
      }
    
      if(diferecia>=172800000){
        return  fecha.getDate() + '/' + ( fecha.getMonth() + 1 ) + '/' + fecha.getFullYear();
       }

    }
  }
    
  }
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){
  
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
      arrayChats.length=0;
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
  constructor(id,nombre,text,dateChat,dateMensaje,sinLeer,user) {
    this.id=id,
    this.nombre=nombre,
    this.text=text,
    this.dateChat=dateChat,
    this.dateMensaje=dateMensaje,
    this.sinLeer=sinLeer,
    this.user=user
  }

  get getId() { return this.id}

  get getNombre() { return this.nombre}

  get getMensaje() { return this.text}

  get getDateChat() { return this.dateChat}

  get getDateMensaje() { return this.dateMensaje}

  get getSinLeer() { return this.sinLeer}

  get getUser() { return this.user}


}
