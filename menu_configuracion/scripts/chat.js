$(document).ready(function(){

  let countOld=0;
  let container=document.querySelector("#container");
  let nMensajes=25;

  let nUsersChat=0;
  

  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  init(); 

  
  //FUNCION QUE NOS DEVUELVE LOS DATOS DEL CHAT
  function datosChat(idChat){
    if(idChat!=0){
      $.post( "controller/chat.php",{action:"chatData2",id_chat:idChat},
    function(data) {
      //console.log(data)
      data=JSON.parse(data);
      document.querySelector("#chatName").textContent = data[0];
      document.querySelector("#chatLogo").textContent = data[0].charAt(0);
      nUsersChat=data[1];

      if(data[2]==-1){
        document.querySelector("#chatLogo").className="icon-image-group-mini";
      }

      if(data[2]<100 && data[2]>=0){
        document.querySelector("#chatLogo").className="icon-image-ofi-mini";
      }

      if(data[2]<200 && data[2]>=100){
        document.querySelector("#chatLogo").className="icon-image-pro-mini";
      }

      if(data[2]<300 && data[2]>=200){
        document.querySelector("#chatLogo").className="icon-image-cli-mini";
      }

    }); 
    }else{
      $.post( "controller/chat.php",{action:"chatData3",id_user:idUser},
    function(data) {
      document.querySelector("#chatName").textContent = data;
      document.querySelector("#chatLogo").textContent = data.charAt(0);
    }); 
    }
     
  }

  //FUNCION QUE NOS DEVUELVE LOS MENSAJES DEL CHAT
  function mensajes(idChat){
    if(idChat!=0){
    $.post( "controller/mensajes.php",{action:"mensajes",idChat:idChat,nMensajes:nMensajes},
    function(data) {
      let newCont=0;
      data=JSON.parse(data);
      container.innerHTML="";

      let idArray=new Array();
      let readUsers=new Array();

      let divMasMensajes = document.createElement("p");
      for(let mensaje of data){
        newCont++;
        let divMensaje = document.createElement("p");
       
        if(mensaje[5]){
          divMensaje.className="div-mensajeLeft";
          let stringHTML="<i class='fas fa-check' style='color:white'></i>"
          if(mensaje[7]==nUsersChat-1){
          stringHTML="<i class='fas fa-check' style='color:#8AFF33'></i>";
          }
          divMensaje.innerHTML="<div class='mensajeVerde'><b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha(mensaje[2])+"</i><br>"+stringHTML+" <span class='txt'>"+mensaje[0]+"</span></div>";
        }else{
          divMensaje.className="div-mensajeRight";
          divMensaje.innerHTML="<div class='mensajeBlanco'><b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha(mensaje[2])+"</i><br><span class='txt'>"+mensaje[0]+"</span></div>";
          idArray.push(mensaje[6])
          readUsers.push(mensaje[3])
        }
        container.appendChild(divMensaje);

        


        if(data.length>=25){
        divMasMensajes.className="div-mensajeCenter";
      divMasMensajes.innerHTML="<div class='mensajeAviso' id='masMensajes'> Ver mas antiguos </div>";
      container.appendChild(divMasMensajes);
      document.querySelector("#masMensajes").addEventListener("click",function(){
        nMensajes=nMensajes*2
        datosChat(idChat);
      })
    }

      }

      mensajeLeido(idArray,readUsers);

      if(countOld!=newCont){
        bajarMensajes()
        countOld=newCont;
      }
       
    });  
  }
  }

//FUNCION QUE ENVIA MENSAJES AL CHAT
  function mandarMensajes(idChat){
    if(idChat!=0){
      let txt=document.querySelector("#textInput").value
      if(txt!=""){
        $.post( "controller/mensajes.php",{action:"insertar",idChat:idChat,txt:txt},
        function(data) {
          console.log(data);
        });
        mensajes(idChat);
        bajarMensajes()
        document.querySelector("#textInput").value = '';
      }
    }else{
      
      let txt=document.querySelector("#textInput").value

      if(txt!=""){
        $.post( "controller/chat.php",{action:"startChat",id_user:idUser,txt:txt},
        function(data) {
          window.history.replaceState("", "", "index.php");
          window.open("chat.php?idChat="+data,"_self");
        });
        mensajes(idChat);
        bajarMensajes()
        document.querySelector("#textInput").value = '';

    }
    
    }
  }
  

    //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
    function vistaFecha(fecha) {
      if(fecha==""){
        return "";
      }else{
      let ahora = new Date().getDate();
      fecha=new Date(fecha);
      
      if(ahora==fecha.getDate()){
       return "Hoy "+ ('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
       }

      if(ahora==fecha.getDate()+1){
 
       return "Ayer "+('0'+fecha.getHours()).slice(-2) + ':' + ('0'+fecha.getMinutes()).slice(-2);
       
      }

      if(ahora>=fecha.getDate()+2){
       return  ('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2) +" "+ ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2)
       
      }
    }
  }


  function mensajeLeido(array,users){

     $.post( "controller/mensajes.php",{action:"setLeido",mensajes:array,leido:users},function(data){
    
     });  
  }
  

  function recargar() {
    mensajes(idChat);
  }


  function bajarMensajes() {
    window.scrollTo(0, $(document).height()+1000);
  }
    
  
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){  
    bajarMensajes();
    datosChat(idChat);
    mensajes(idChat);
    window.scrollTo(0,0);    
    setInterval(function(){recargar()},1000);

  

    document.querySelector("#textInput").addEventListener("focus",function(){
      bajarMensajes();
      setTimeout(bajarMensajes, 200);
     
    })


    document.querySelector("#sendMensaje").addEventListener("click",function(){
      mandarMensajes(idChat);     
    })

    document.addEventListener("keydown",function(e){


      if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        mandarMensajes(idChat);
        e.preventDefault();
    }
    })


   
  }

});

