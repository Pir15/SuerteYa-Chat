$(document).ready(function(){
  let nMensajesAdminTotales=-1;
  let adminName=document.querySelector("#admin-tab")
  let adminNameOriginal=adminName.innerHTML;

  let arrayChats=new Array();
 
  
  let ultimaCargaDatosAdmin;

  var conn = new WebSocket('wss://angelmediatec.ddns.net/wss'); //conectara con el websocket
				
  conn.onopen = function (e) { //si la conexion es existossa
   console.log('WebSocketOK')
  };

 //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
 init(); 




//FUNCION QUE LISTA LOS CHATS DEL USUARIO
 function listarChat() {
   $.post( "controller/admin.php",{action:"listarChat"},
   function(data) {
    //  console.log(data)
    // if(ultimaCargaDatosAdmin!=data){
    //   ultimaCargaDatosAdmin=data
     data=JSON.parse(data);
     if(data.length>0){
      arrayChats.length=0;
     for(let i=0;i<data.length;i++) {
     
       let chatObjet=new Array(data[i][0],data[i][2],data[i][4],data[i][3],data[i][5],data[i][6],data[i][7],data[i][1],data[i][8],data[i][9]);
       arrayChats.push(chatObjet);
     }
   }else{
    document.querySelector("#chatOficina").innerHTML="<div class='d-flex flex-column justify-content-center' style=' min-height:90vh'><div class='display-6 text-center'>Todavía no hay mensajes. "+
    "Sé el primero en conversar.</div></div>";
   }
   dibujarChat()
  //}
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

  let nMensajesAdmin=0;

  if(arrayChats.length>0){
    quitarScrollCarga();
    document.querySelector("#chatAdmin").innerHTML="";
   
    for(let i=0;i<arrayChats.length;i++){
      let chatContainer=document.createElement("p");
      let fecha=vistaFecha(arrayChats[i][4])
      let nMensajes=arrayChats[i][5];
      let id=arrayChats[i][0];

      let HTMLcard='<div class="chat-card  " id="'+arrayChats[i][0]+'" msg="'+nMensajes+'">'
      
      chatContainer.addEventListener("click",function(){
        window.history.replaceState("", "", "index.php?lsc="+187);
        window.open("chat.php?idChat="+btoa(id)+"&msg="+nMensajes+"&rusr="+187,"_self");
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
        nMensajesAdmin+=arrayChats[i][5]
        

      }
      chatContainer.innerHTML=HTMLcard+"</div>";

      
    
    document.querySelector("#chatAdmin").appendChild(chatContainer);
   
    
    }
    if(nMensajesAdmin>0){
      adminName.innerHTML=adminNameOriginal+" ("+nMensajesAdmin+")";
    }else{
      adminName.innerHTML=adminNameOriginal
    }

    if(nMensajesAdminTotales==-1){
      nMensajesAdminTotales=nMensajesAdmin;
    }
    
    if(nMensajesAdminTotales<nMensajesAdmin){
      mandarNotificacion("Ha recibido un mensaje en ADMINISTRACION");
      nMensajesAdminTotales=nMensajesAdmin;
    }
    

  }


   //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
   function vistaFecha(fecha) {
     
     if(fecha==""){
       return "";
     }else{

     let ahora = new Date();
     fecha=new Date(fecha.replace(/-/g, "/"));

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
    conn.onmessage = function (e) {
        var respuesta = JSON.parse(e.data); //recibimos la respuesta y como es json la parseamos
        if(respuesta.idUsers!=null && respuesta.idUsers.includes("187,")){
            recargar();
         }
    }
    //setInterval(function(){recargar()},2000);
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


window.addEventListener("resize", function(){
  dibujarChat()
});


});