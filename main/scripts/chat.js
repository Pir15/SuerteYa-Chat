$(document).ready(function(){

    let countOld=0;
    let container=document.querySelector("#container");
    let nMensajes=25;
    let nUsersChat=0;
    let usuariosChat;
  
  function getChannelIcon(globalUser){
  
    let icon;
    switch (globalUser) {
      case 0:
        icon="";
        break;
      case '18':
        icon='<i class="far fa-window-maximize"></i>&nbsp ';
        break;
      case '19':
        icon=' <i class="fa-solid fa-phone"></i>&nbsp';
        break;
      case '21':
        icon='<i class="fa-solid fa-laptop"></i>&nbsp';
        break;
      case '187':
        icon='<i class="fa-solid fa-file-contract"></i>&nbsp';
        break;
    }
  
    return icon;
  }
   
  
    
    let ultimoRegistroMensajes;
  
    var conn = new WebSocket('wss://angelmediatec.ddns.net/wss'); //conectara con el websocket
                  
                  conn.onopen = function (e) { //si la conexion es existossa
                      var enviar = {'type':'openChat','idChat':idChat,'idUsers':usuariosChat}; //lo guardamos en un array
                      conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
                    
                  };
  
                  
  
  
    //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
    init(); 
  
    
  
  
    
    //FUNCION QUE NOS DEVUELVE LOS DATOS DEL CHAT
    function datosChat(idChat){
      
      if(idChat!=0){
        $.post( "controller/chat.php",{action:"chatData2",id_chat:idChat,globalUser:globalUser},
      function(data) {
       
        data=JSON.parse(data);
        
      
        document.querySelector("#chatName").innerHTML =getChannelIcon(globalUser)+ data[0];
        document.querySelector("#Nombre").innerHTML = getChannelIcon(globalUser)+data[0];
        document.querySelector("#nameInput").innerHTML=getChannelIcon(globalUser)+data[0];
        nUsersChat=data[1];
        usuariosChat=data[7];
  
        if(data[3]!="" && data[3]!=null){
          document.querySelector("#chatLogo").style="background-image:url(../img/avatar/"+ data[3]+");background-color:white";
          document.querySelector("#chatLogo").className="icon-image-mini";
          //let img=document.createElement("img");
          // img.src="../img/avatar/"+ data[3];
          // img.className="img-ico-mini"
          // document.querySelector("#chatLogo").appendChild(img);
          document.querySelector("#avatar").style="background-image:url(../img/avatar/"+ data[3]+");background-color:white";
        }else{
  
          document.querySelector("#chatLogo").textContent = data[0].charAt(0);
          document.querySelector("#chatLogo").className="icon-image-mini";
          document.querySelector("#avatar").style="background-image:none;background-color:green;color:white;font-size:1.5em";
          document.querySelector("#avatar").textContent=data[0].charAt(0);
        }
          
          if(data[4]=="INDIVIDUAL"){
            
            
            document.querySelector("#usuarios").style.display="block";
            document.querySelector("#usuarios").textContent=data[5];
          
            
          }
  
          if(data[4]=="GRUPO"){
            if(data[6]==true){
              document.querySelector("#anadirUser").style.display="block";
              document.querySelector("#anadirAdmin").style.display="block";
              document.querySelector("#editGroup").style.display="block";
            }
           
            document.querySelector("#salirGrupo").style.display="block";
            document.querySelector("#usuarios").style.display="block";
            document.querySelector("#usuarios").textContent=data[5];
            mostrarContactos(data[5],data[7].split(","))
            document.querySelector("#chatLogo").style.backgroundColor="green";
            document.querySelector("#avatar").style="background-image:none;background-color:green;color:white;font-size:1.5em";
          }
  
          
  
         
        
        
  
       
  
      }); 
      }else{
        $.post( "controller/chat.php",{action:"chatData3",id_user:idUser,globalUser:0},
      function(data) {
       
        data=JSON.parse(data);
        document.querySelector("#chatName").textContent = data[0];
        if(data[2]!="" && data[2]!=null){
          document.querySelector("#chatLogo").style="background-image:url(../img/avatar/"+ data[2]+");background-color:white";
          document.querySelector("#chatLogo").className="icon-image-mini";
        }else{
          document.querySelector("#chatLogo").textContent = data[0].charAt(0);
          document.querySelector("#chatLogo").className="icon-image-mini";
        }
    });
     
  }
}

  //FUNCION QUE NOS DEVUELVE LOS MENSAJES DEL CHAT
  function mensajes(idChat){
    if(idChat!=0){
    $.post( "controller/mensajes.php",{action:"mensajes",idChat:idChat,nMensajes:nMensajes,globalUser:globalUser},
    function(data) {

      if(data!=ultimoRegistroMensajes){
        //console.log(data);
        ultimoRegistroMensajes=data;
      let newCont=0;
      data=JSON.parse(data);
      container.innerHTML="";

      let idArray=new Array();
      let readUsers=new Array();

      let divMasMensajes = document.createElement("p");
      for(let mensaje of data){
        newCont++;
        let divMensaje = document.createElement("p");


       
        // divMensaje.addEventListener('touchstart',function(){
        //   start = Date.now();
        //   sTimeout = setTimeout(function(){
        //    console.log($("#modalMensaje"))
        //    $("#modalMensaje").modal('show');
        //   }, 2000);
        // })

        // divMensaje.addEventListener('touchdown',function(){
        //   end = Date.now();
        //   elapse = end - start
        //   if(elapse < 2000){
        //     clearTimeout(sTimeout);
        //   }
        // })

       
        if(mensaje[5]){
          divMensaje.className="div-mensajeLeft";
          let stringHTML="<i class='fas fa-check' style='color:white'></i>"
          if(mensaje[7]==nUsersChat-1){
          stringHTML="<i class='fas fa-check' style='color:#8AFF33'></i>";
          }
          let mensajeVerde=document.createElement("div");
          mensajeVerde.className="mensajeVerde";
          mensajeVerde.style='max-width:'+window.innerWidth/1.5+'px;';
          mensajeVerde.innerHTML=stringHTML+" <b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha(mensaje[2])+"</i><br><span class='txt'>"+urlify(mensaje[0])+"</span>";
          
          mensajeVerde.addEventListener('mousedown',function(){
          start = Date.now();
          sTimeout = setTimeout(function(){
            infoMensaje(mensaje);
          }, 2000);
        })

        mensajeVerde.addEventListener('mouseup',function(){
            timePulseButton()
          
        })

        mensajeVerde.addEventListener('touchstart',function(){
            start = Date.now();
            sTimeout = setTimeout(function(){
              infoMensaje(mensaje);
            }, 2000);
          })
  
          mensajeVerde.addEventListener('touchend',function(){
              timePulseButton()
            
          })

        

          
          divMensaje.appendChild(mensajeVerde);
          
        }else{
          divMensaje.className="div-mensajeRight";
          let mensajeBlanco=document.createElement("div");
          mensajeBlanco.className="mensajeBlanco";
          mensajeBlanco.style='max-width:'+window.innerWidth/1.5+'px;';
          mensajeBlanco.innerHTML="<b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha(mensaje[2])+"</i><br><span class='txt'>"+urlify(mensaje[0])+"</span>";

          mensajeBlanco.addEventListener('mousedown',function(){
            start = Date.now();
            sTimeout = setTimeout(function(){
                infoMensaje(mensaje);
            
            }, 2000);
          })
  
          mensajeBlanco.addEventListener('mouseup',function(){
            timePulseButton()
          })

          mensajeBlanco.addEventListener('touchstart',function(){
            start = Date.now();
            sTimeout = setTimeout(function(){
                infoMensaje(mensaje);
            
            }, 2000);
          })
  
          mensajeBlanco.addEventListener('touchend',function(){
            timePulseButton()
          })

          divMensaje.appendChild(mensajeBlanco);
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
        mensajes(idChat);
      })
    }

      }

      mensajeLeido(idArray,readUsers);

      if(countOld!=newCont){
        bajarMensajes()
        countOld=newCont;
      }

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
         
        });
        var enviar = {'type':'mensaje','idChat':idChat,'idUsers':usuariosChat}; //lo guardamos en un array
        conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
        mensajes(idChat);
        bajarMensajes()
        document.querySelector("#textInput").value = '';
      }
    }else{
      
      let txt=document.querySelector("#textInput").value

      if(txt!=""){
        $.post( "controller/chat.php",{action:"startChat",id_user:idUser,txt:txt,globalUser:globalUser},
        function(data) {
          //console.log(data);
          window.history.replaceState("", "", "index.php");
          window.open("chat.php?idChat="+btoa(data)+"&rusr="+globalUser,"_self");
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

      let ahora = new Date();
      fecha=new Date(fecha.replace(/-/g, "/"));

      let ahoraCalc=ahora.getFullYear()+"-"+('0'+ahora.getMonth()).slice(-2)+"-"+('0'+ahora.getDate()).slice(-2);
      let fechaCalc=fecha.getFullYear()+"-"+('0'+fecha.getMonth()).slice(-2)+"-"+('0'+fecha.getDate()).slice(-2);
  
      if(ahoraCalc==fechaCalc){
        return ('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
       }

      if(ahoraCalc>=fechaCalc){
        
        return ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2)+" "+('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
      }
    }
  }

  //FUNCION QUE NOS MUESTRA LA FECHA Y HORA ADECUADA
  function vistaFecha2(fecha) {
      
    if(fecha==""){
      return "";
    }else{

    let ahora = new Date();
    fecha=new Date(fecha.replace(/-/g, "/"));
    return ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2)+" "+('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
  }
}
  


  function mensajeLeido(array,users){

    

     $.post( "controller/mensajes.php",{action:"setLeido",mensajes:array,leido:users},function(data){
    
      var enviar = {'type':'mensajeLeido','idChat':idChat,'idUsers':usuariosChat}; //lo guardamos en un array
                conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
     });  
  }
  

  function recargar() {
    mensajes(idChat);
  }


  function bajarMensajes() {
    window.scrollTo(0, $(document).height()+1000);
  }

  function comprobarInactividad(){
    if( typeof Android!== 'undefined'){
     
    }else{
      var inactivo = 0;
      setInterval(tiempoInactivo, 1000); 
      $(this).mousemove(function (e) {
          inactivo = 0;
      });
      $(this).keypress(function (e) {
          inactivo = 0;
      });

      $(this).keyup(function (e) {
        inactivo = 0;
      });
      function tiempoInactivo() {      
            inactivo = inactivo + 1;
            if (inactivo >= 60) {
              window.open("index.php","_self");
            }
        }
    }
    
}
    
  
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){  
 
    if(msg>25){
      nMensajes=msg;
    }
    bajarMensajes();
    datosChat(idChat);
    mensajes(idChat);
    window.scrollTo(0,0);
    conn.onmessage = function (e) {
      var respuesta = JSON.parse(e.data); //recibimos la respuesta y como es json la parseamos
      console.log(respuesta);
      if(respuesta.idChat==idChat){
        if(respuesta.type=="addUser" || respuesta.type=="addAdmin" || respuesta.type=="editGroup" ){
            location.reload();
        }else{
            recargar();
        }
      }
    }
    //setInterval(function(){recargar()},2000);

  

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

    comprobarInactividad()
   
  }



  function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
      return '<a href="' + url + '" target="_blank">' + url + '</a>';
    })
    // or alternatively
    // return text.replace(urlRegex, '<a href="$1">$1</a>')
  }
  

  const button = document.querySelector('#emoji-button');

const picker = new EmojiButton();

button.addEventListener('click', () => {
  picker.togglePicker(button);
  
});

  picker.on('emoji', emoji => {
    document.querySelector('#textInput').value += emoji;
  });


  window.addEventListener("resize", function(){
    ultimoRegistroMensajes="";
    mensajes(idChat);
  });


 //SALR DEL GRUPO
 document.querySelector("#salirGrupo").addEventListener('click',function(){
  $.post( "controller/contactos.php",{action:"salirGrupo",idChat:idChat});
  window.open("index.php","_self");
})

//VER SELECTOR NUEVO USUARIO

document.querySelector("#anadirUser").addEventListener('click',function(){
  $("#modalAddUser").toggle();
  $("#modalAddAdmin").hide();
  $("#modalChangeGroup").hide()
})

//VER SELECTOR NUEVO ADMINISTRADOR

document.querySelector("#anadirAdmin").addEventListener('click',function(){
  $("#modalAddAdmin").toggle();
  $("#modalAddUser").hide();
  $("#modalChangeGroup").hide()
})

//VER OPCIONES EDITAR GRUPO


document.querySelector("#editGroup").addEventListener('click',function(){
  $("#modalChangeGroup").toggle();
  $("#modalAddAdmin").hide();
  $("#modalAddUser").hide();
})

//AÑADIR USUARIO AL GRUPO
document.querySelector("#insertNewUser").addEventListener('click',function(){

  let select=document.querySelector("#userList"); 
      var result = [];
      var options = select && select.options;
      var opt;
    
      for (var i=0, iLen=options.length; i<iLen; i++) {
        opt = options[i];
    
        if (opt.selected) {
          result.push(opt.id || opt.id);
        }
      }

    
  $.post( "controller/contactos.php",{action:"addGroupUser",userList:result,idChat:idChat},function(data){
    var enviar = {'type':'addUser','idChat':idChat}; //lo guardamos en un array
                conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
      window.open("chat.php?idChat="+btoa(idChat),"_self");
  })
});

//SELECT DE USUARIOS DEL CHATAS
function mostrarContactos(array1,array2){
  document.querySelector("#userListChat").innerHTML="";
  for(let i=0;i<array1.length;i++){
      let contacto=document.createElement("option");
      contacto.textContent=array1[i];
      contacto.id=array2[i];
  document.querySelector("#userListChat").appendChild(contacto)
  }
}



  //AÑADIR ADMINISTRADOR AL GRUPO
  document.querySelector("#insertNewAdmin").addEventListener('click',function(){

    let select=document.querySelector("#userListChat"); 
        var result = [];
        var options = select && select.options;
        var opt;
      
        for (var i=0, iLen=options.length; i<iLen; i++) {
          opt = options[i];
      
          if (opt.selected) {
            result.push(opt.id || opt.id);
          }
        }

      
    $.post( "controller/contactos.php",{action:"addGroupAdmin",userList:result,idChat:idChat},function(data){
        var enviar = {'type':'addAdmin','idChat':idChat}; //lo guardamos en un array
        conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
        window.open("chat.php?idChat="+btoa(idChat),"_self");
    })
  });


   //EDITAR GRUPO
   document.querySelector("#updateChat").addEventListener('click',function(){

    let nombre=document.querySelector("#nameInput").value;

      
    $.post( "controller/contactos.php",{action:"editGroup",name:nombre,idChat:idChat},function(data){
        var enviar = {'type':'editGroup','idChat':idChat,'idUsers':usuariosChat}; //lo guardamos en un array
        conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
        window.open("chat.php?idChat="+btoa(idChat),"_self");
    })
  });

  document.querySelector("#copiarMensaje").addEventListener('click',function(){
    let user,date,txt

    if(document.querySelector("#mensajeModalDiv").childNodes[0].className=="mensajeBlanco"){
       user=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[0].textContent
       date=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[1].textContent
       txt=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[3].textContent
    }else{
      console.log(document.querySelector("#mensajeModalDiv").childNodes[0].childNodes)
       user=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[2].textContent
       date=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[3].textContent
       txt=document.querySelector("#mensajeModalDiv").childNodes[0].childNodes[5].textContent
    }

    
   

    let copy=user+" ["+date+"] "+txt
    navigator.clipboard.writeText(copy);
    document.querySelector("#mensajeCopiadoOk").style.display="block";
  })

  function infoMensaje(mensaje){
  let mensajeModalDiv=document.querySelector("#mensajeModalDiv");
  if(mensaje[5]){
   let stringHTML="<i class='fas fa-check' style='color:white'></i>"
   if(mensaje[7]==nUsersChat-1){
   stringHTML="<i class='fas fa-check' style='color:#8AFF33'></i>";
    }
    document.querySelector("#borrarMensaje").style="display:block";
    mensajeModalDiv.innerHTML="<div class='mensajeVerde' style='max-width:"+window.innerWidth/1.5+"px;'>"+stringHTML+" <b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha2(mensaje[2])+"</i><br><span class='txt'>"+urlify(mensaje[0])+"</span></div>"
    }else{
        document.querySelector("#borrarMensaje").style="display:none";
    mensajeModalDiv.innerHTML="<div class='mensajeBlanco' style='max-width:"+window.innerWidth/1.5+"px;'><b>"+mensaje[4]+"</b><i class='date-label'> "+vistaFecha2(mensaje[2])+"</i><br><span class='txt'>"+urlify(mensaje[0])+"</span></div>";
    }

  
    document.querySelector("#mensajeCopiadoOk").style.display="none";
    $("#modalMensaje").modal('show');
    } 

function timePulseButton(){
    end = Date.now();
    elapse = end - start
    if(elapse < 2000){
      clearTimeout(sTimeout);
    } 
}

});

