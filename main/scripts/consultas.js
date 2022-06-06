
$(document).ready(function(){
 
    let ultimaCargaDatos="";




  //FUNCION QUE LISTA LOS CHATS DEL USUARIO
  function listarChat() {
    $.post( "controller/consultas.php",{action:"listar"},
    function(data) {    
      console.log(data)
      if(JSON.parse(data).length>0 && data!=ultimaCargaDatos){
        ultimaCargaDatos=data;
        
        data=JSON.parse(data);
        pintarChats(data);
       
    }else{
        if(JSON.parse(data).length<=0){
            document.querySelector("#chatConsultas").innerHTML="<div class='d-flex flex-column justify-content-center' style=' min-height:90vh'><div class='display-6 text-center'>Aún no ha recibido ninguna consulta.</div>";
        }
    }
      
    },
   ); 
  }

  function pintarChats(data){
    document.querySelector("#chatConsultas").innerHTML="";
    for(let i=0;i<data.length;i++){
      let chatContainer=document.createElement("p");
      let chatCard=document.createElement("div");
      chatCard.className="chat-card justify-content-between ml-3";
      chatCard.id=data[i][0];
      let fecha
      if(data[i][5]!=null){
       fecha=vistaFecha(data[i][5])
      }else{
        fecha='&nbsp'
      }

   

      

      let leftCard=document.createElement("div");
      let datos=document.createElement("div");
      datos.className="chat-body mr-2"
      datos.innerHTML='<b>'+data[i][1]+'</b><i class="date-label"> '+fecha+'</i></div>'
      datos.style="min-width:150px"
      let iconImage=document.createElement("div");
      iconImage.className="icon-image";
      iconImage.textContent=data[i][1].charAt(0).toUpperCase();
      
      
      leftCard.className="d-flex align-items-center"
      leftCard.appendChild(iconImage);
   
      if(data[i][2]!=null){
        datos.innerHTML+='<div class="text-nowrap" style="overflow: hidden;text-overflow: ellipsis; max-width:'+window.innerWidth/2+'px;"> '+data[i][3]+': '+data[i][2]+'</div></div>';
      }
     
      leftCard.appendChild(datos);

     
      

      chatCard.appendChild(leftCard)

      
      let cardCenter=document.createElement("div");
      let cardRight=document.createElement("div");
      cardRight.className="d-flex flex-row align-items-center justify-content-between"
      let icon1=document.createElement("h1");
      let icon2=document.createElement("h1");

      if(data[i][4]!=0){
        cardRight.innerHTML+='<div  class="icon-mensajes" id="nMensajes">'+data[i][4]+'</div>'
      }
     

      cardCenter.appendChild(icon1)
      cardRight.appendChild(icon2)

      chatCard.appendChild(cardCenter);
      chatCard.appendChild(cardRight)
      
      chatContainer.appendChild(chatCard)
      chatContainer.addEventListener("click",function(){
        window.open("consultas.php?consulta="+btoa(data[i][0]),"_self");

      });

    document.querySelector("#chatConsultas").appendChild(chatContainer);
  }
}





  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){
    listarChat() 
    setInterval(function(){recargar()},1000);
  }

  function recargar() {
    listarChat()  
    
    //   dibujarChat()
    //   let chats=document.querySelectorAll(".chat-card")
    //   for(let i=0;i<chats.length;i++){
    //     chats[i].addEventListener("click",function(){
    //       window.open("chat.php?idChat="+chats[i].id,"_self");
    //     })
    //   }
    //   arrayChats.length=0;
 }


 function compararArrays(array1,array2) {

    Array.prototype.equals = function (getArray) {
        if (this.length != getArray.length) return false;
      
        for (var i = 0; i < getArray.length; i++) {
          if (this[i] instanceof Array && getArray[i] instanceof Array) {
            if (!this[i].equals(getArray[i])) return false;
          } else if (this[i] != getArray[i]) {
            return false;
          }
        }
        return true;
      };

      return array1.equals(array2)

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


  window.addEventListener("resize", function(){
    ultimaCargaDatos="";
      listarChat()
  });

  init();

});