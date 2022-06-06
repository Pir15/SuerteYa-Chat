$(document).ready(function(){

  let nMensajesVentanillaTotales=-1;
  let ventName=document.querySelector("#ventanilla-tab")
  let ventNameOriginal=ventName.innerHTML;
  let arrayChats=new Array();
  let ultimaCargaDatosVentanilla;
 

 //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
 init(); 




//FUNCION QUE LISTA LOS CHATS DEL USUARIO
 function listarChat() {
   $.post( "controller/ventanilla.php",{action:"listarChat"},
   function(data) {
     
    if(ultimaCargaDatosVentanilla!=data){
      ultimaCargaDatosVentanilla=data
     data=JSON.parse(data);
     if(data.length>0){
     for(let i=0;i<data.length;i++) {
     
       let chatObjetVentanilla=new Array(data[i][0],data[i][2],data[i][4],data[i][3],data[i][5],data[i][6],data[i][7],data[i][1],data[i][8],data[i][9]);
       arrayChats.push(chatObjetVentanilla);
     }
   }else{
    document.querySelector("#chatOficina").innerHTML="<div class='d-flex flex-column justify-content-center' style=' min-height:90vh'><div class='display-6 text-center'>Todavía no hay mensajes. "+
    "Sé el primero en conversar.</div></div>";
   }
   dibujarChat()
  }
   },
  ); 
 }

 


 

 //FUNCION QUE DIBUJA LOS CHAT EN PANTALLA
 function dibujarChat(){
   
  arrayText=new Array();
  arrayNoText=new Array();

  for(let chat of arrayChats){
    
    if(chat[4]==""){
      arrayNoText.push(chat)
    }else{
      arrayText.push(chat)
    }
  }
  
  arrayText.sort(function (a, b) {
      if (a[4] < b[4]) {
        return 1;
      }
      if (a[4] > b[4]) {
        return -1;
      }
      
      return 0;
  });

  arrayNoText.sort(function (a, b) {
    if (a[3] < b[3]) {
      return 1;
    }
    if (a[3] > b[3]) {
      return -1;
    }
    
    return 0;
});

arrayChats=arrayText.concat(arrayNoText)

  let nMensajesVentanilla=0;

  if(arrayChats.length>0){
    quitarScrollCarga();
    document.querySelector("#chatVentanilla").innerHTML="";
   
    for(let i=0;i<arrayChats.length;i++){
      let chatContainer=document.createElement("p");
      let fecha=vistaFecha(arrayChats[i][4])
      let nMensajes=arrayChats[i][5];
      let id=arrayChats[i][0];

      let HTMLcard='<div class="chat-card" id="'+arrayChats[i][0]+'" msg="'+nMensajes+'">'
      
      chatContainer.addEventListener("click",function(){
        window.open("chat.php?idChat="+btoa(id)+"&msg="+nMensajes+"&rusr="+18,"_self");
      })

      if(arrayChats[i][9]=="" || arrayChats[i][9]==null){
      HTMLcard+='<div class="icon-image">'+arrayChats[i][1].charAt(0)+'</div>'+
      '<div class="chat-body"><div><b>'+arrayChats[i][1]+'</b><i class="date-label"> '+fecha+'</i></div>';
      }else{
        HTMLcard+='<div class="icon-image" style="background-image:url(../img/avatar/'+arrayChats[i][9]+');background-color:white"></div>'+
      '<div class="chat-body"><div><b>'+arrayChats[i][1]+'</b><i class="date-label"> '+fecha+'</i></div>';
      }
      
      if(arrayChats[i][2]!=""){
       
        HTMLcard+='<div class="text-nowrap" style="overflow: hidden;text-overflow: ellipsis; max-width:'+window.innerWidth/2+'px;"> '+arrayChats[i][6]+': '+arrayChats[i][2]+'</div></div>';
    
         
      }

      if(nMensajes>0){
        HTMLcard+='<div  class="icon-mensajes m-1" id="nMensajes">'+arrayChats[i][5]+'</div>';
        nMensajesVentanilla+=arrayChats[i][5]
       

      }
      chatContainer.innerHTML=HTMLcard+"</div>";

      

    document.querySelector("#chatVentanilla").appendChild(chatContainer);
   
    
    }
    
    if(nMensajesVentanilla>0){
      ventName.innerHTML=ventNameOriginal+" ("+nMensajesVentanilla+")";
    }else{
      ventName.innerHTML=ventNameOriginal
    }


    if(nMensajesVentanillaTotales==-1){
      nMensajesVentanillaTotales=nMensajesVentanilla;
    }
    
    if(nMensajesVentanillaTotales<nMensajesVentanilla){
      mandarNotificacion("Ha recibido un mensaje en VENTANILLA");
      nMensajesVentanillaTotales=nMensajesVentanilla;
    }

     arrayChats.length=0;
  }


   //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
   function vistaFecha(fecha) {
     
     if(fecha==""){
       return "";
     }else{

     let ahora = new Date();
     fecha=new Date(fecha);

    let ahoraCalc=ahora.getFullYear()+"-"+('0'+ahora.getMonth()).slice(-2)+"-"+('0'+ahora.getDate()).slice(-2);
     let fechaCalc=fecha.getFullYear()+"-"+('0'+fecha.getMonth()).slice(-2)+"-"+('0'+fecha.getDate()).slice(-2);
 
     if(ahoraCalc==fechaCalc){
       return ('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
      }

     if(ahoraCalc>=fechaCalc){
       
       return ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2);
     }
   }
 }
   
 }
 
 //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
 function init(){
   setTimeout(function(){recargar()},200);
   setInterval(function(){recargar()},1000);
 }

 //FUNCION QUE CARGA EL CODIGO QUE SE EJECUTARÁ EN BUCLE
 function recargar() {
   listarChat()  
    
    //  let chats=document.querySelectorAll(".chat-card")
    //  for(let i=0;i<chats.length;i++){
       
    //    chats[i].addEventListener("click",function(){
    //      window.open("chat.php?idChat="+btoa(chats[i].id)+"&msg="+chats[i].getAttribute("msg"),"_self");
    //    })
    //  }

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