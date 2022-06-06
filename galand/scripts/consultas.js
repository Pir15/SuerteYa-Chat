$(document).ready(function(){

  let countOld=0;
  let container=document.querySelector("#container");
  let nMensajes=25;
  let nUsersChat=0;

  let precio;
  let ultimoEstado;
  let ultimoRegistroMensajes;
  let pvp;


  setTimeout(function(){
    if(document.querySelector("#chatName").textContent==""){
      console.log("NO SE HAN CARGADO LOS DATOS");
      datosChat(idChat);
    }
    
  }, 500);

  
  function mostrarEstado(est){
    let ret;
    switch(est){
      case "5":
        ret='<i class="fa-solid  fa-phone-slash text-danger"></i>'
      break;
      case "1":
        ret='<i class="fa-solid fa-circle-check text-success"></i>'
      break;
      case "2":
        ret='<i class="fa-solid fa-stop text-primary"></i>'
      break;
      case "3":
        ret='<i class="fa-solid fa-phone text-warning"></i>'
      break;
      case "4":
        ret='<i class="fa-solid fa-phone text-warning"></i>'
      break;
    }

    return ret;
  }

  function mostrarEstado2(est){
    let ret;
    switch(est){
      case "5":
        ret='<i class="fa-solid fa-phone-slash  text-danger"></i> Se encuentra encuentra ahora mismo desconectado.'
      break;
      case "1":
        ret='<i class="fa-solid fa-circle-check text-success"></i> Se encuentra encuentra ahora mismo activo.'
      break;
      case "2":
        ret='<i class="fa-solid fa-stop text-primary"></i> Se encuentra ahora mismo en descanso. Es posible que tarde en responder'
      break;
      case "3":
        ret='<i class="fa-solid fa-phone text-warning"></i> Se encuentra encuentra ahora mismo en consulta. Es posible que tarde en responder'
      break;
      case "4":
        ret='<i class="fa-solid fa-phone text-warning"></i> Se encuentra encuentra ahora mismo en consulta. Es posible que tarde en responder'
      break;
    }

    return ret;
  }
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  init(); 

  
  //FUNCION QUE NOS DEVUELVE LOS DATOS DEL CHAT
  function datosChat(idChat){
    
      $.post( "controller/chat.php",{action:"datosChat",id_chat:idChat},
    function(data) {
      $('#divLoad').modal("hide");
      console.log(data);
      data=JSON.parse(data);
      pvp=data[3];
      let highTarifa=tarifas.length-1;
      highTarifa=tarifas[highTarifa]
      let maxPrecio=highTarifa[3]*pvp;
      maxPrecio=Math.round((maxPrecio) * 100) / 100
      if(data[5]<maxPrecio){
        $('#modalSinSaldo').modal('show');
        document.querySelector("#textInput").setAttribute("disabled","true");
      }else{

      if(data[4]==5){
        $('#modalProfesionalDesconectado').modal('show');
        setTimeout(function() {
          $('#modalProfesionalDesconectado').modal("hide");
        }, 5000);
        document.querySelector("#textInput").setAttribute("disabled","true");
      }

    }

      rellenarModal(data[0])
      
      document.querySelector("#icoEstado").innerHTML=mostrarEstado(data[4]);
      ultimoEstado=data[4];
      document.querySelector("#chatName").textContent = data[1];
      nUsersChat=data[1];
      let chatLogo=document.querySelector("#chatLogo")
      if(data[2]!="" && data[2]!=null){
        let url="https://suerteya.com/fotosprof/"+data[2]+".jpg";
        chatLogo.style.backgroundImage = 'url(' + '"' + url + '"' + ')';
        chatLogo.className="icon-image-mini";
      }else{
        chatLogo.textContent = data[1].charAt(0);
        chatLogo.className="icon-image-mini";
      }
   

      document.querySelector("#saldo").textContent=data[5]+" €";

      
    
    }); 



   
    
  }


  function comprobarEstado(chat){
    $.post( "controller/chat.php",{action:"estadoChat",id_chat:chat},
    function(data) {
      if(data!=ultimoEstado){
        ultimoEstado=data;
        rellenarModal(chat)
        document.querySelector("#icoEstado").innerHTML=mostrarEstado(data);
        if(data==5){
          document.querySelector("#textInput").setAttribute("disabled","true");
        }else{
          document.querySelector("#textInput").removeAttribute("disabled");
        }
      }
    });
  }


  let closebtn=document.querySelectorAll(".close")

  for(btn of closebtn){
    btn.addEventListener("click",function(){
      $('#modalProfesionalDesconectado').modal('hide');
      $('#infoProfesional').modal('hide');
      $('#modalSinSaldo').modal('hide');
    })
  }



  //FUNCION QUE NOS DEVUELVE LOS MENSAJES DEL CHAT
  function mensajes(idChat){
    if(idChat!=0){
    $.post( "controller/mensajes.php",{action:"mensajes",idChat:idChat,nMensajes:nMensajes},
    function(data) {
      console.log(data)
      if(data!=ultimoRegistroMensajes){
        ultimoRegistroMensajes=data;
      //console.log(data);
      let newCont=0;
      data=JSON.parse(data);
      container.innerHTML="";

      let idArray=new Array();
      

      let divMasMensajes = document.createElement("p");
      for(let mensaje of data){
        newCont++;
        let divMensaje = document.createElement("p");
       
        if(mensaje[8]){
          divMensaje.className="div-mensajeLeft";
          divMensaje.innerHTML="<div class='mensajeVerde' style='max-width:"+window.innerWidth/1.5+"px;'><b>"+mensaje[7]+"</b><i class='date-label'> "+vistaFecha(mensaje[5])+"</i><br><span class='txt'>"+mensaje[1]+"</span></div>";
        }else{
          divMensaje.className="div-mensajeRight";
          divMensaje.innerHTML="<div class='mensajeBlanco' style='max-width:"+window.innerWidth/1.5+"px;'><b>"+mensaje[7]+"</b><i class='date-label'> "+vistaFecha(mensaje[5])+"</i><br><span class='txt'>"+mensaje[1]+"</span></div>";
          idArray.push(mensaje[0])
       
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
 
      mensajeLeido(idArray);

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
      let txt=document.querySelector("#textInput").value
      if(txt!=""){
        let car=txt.length;
        $.post( "controller/mensajes.php",{action:"insertar",idChat:idChat,txt:txt,car:car},
        function(data) {
         console.log(data)
        });
        mensajes(idChat);
        bajarMensajes();
        comprobarSaldo();
        document.querySelector("#textInput").value = '';
        document.querySelector("#nCaracteres").textContent="0/1000"
      } 
  }


  function comprobarSaldo(){
    $.post( "controller/chat.php",{action:"getSaldo"},
    function(data) {
      document.querySelector("#saldo").textContent=data+" €";
      let highTarifa=tarifas.length-1;
      highTarifa=tarifas[highTarifa]
      let maxPrecio=highTarifa[3]*pvp;
      maxPrecio=Math.round((maxPrecio) * 100) / 100
      if(data<maxPrecio){
        $('#modalSinSaldo').modal('show');
        document.querySelector("#textInput").setAttribute("disabled","true");
      }

     });
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
        
        return ('0'+fecha.getDate()).slice(-2) + '/' + ( '0'+(fecha.getMonth() + 1) ).slice(-2)+" "+('0'+fecha.getHours()).slice(-2)+ ':' + ('0'+fecha.getMinutes()).slice(-2);
      }
    }
  }
  


  function mensajeLeido(array){
     $.post( "controller/mensajes.php",{action:"setLeido",mensajes:array},function(data){
      //console.log(data);
     });  
  }
  

  function recargar() {
    comprobarEstado(idChat)
    mensajes(idChat);
  }


  function bajarMensajes() {
    window.scrollTo(0, $(document).height()+1000);
  }

  document.querySelector("#textInput").addEventListener("keyup",function(e){
    let length=document.querySelector("#textInput").value.length;
    let precio=obtenerPrecio(length);
    if (precio>0){
      document.querySelector("#nCaracteres").innerHTML=length+"/1000 &nbsp<b>"+precio+" €</b>"
    }else{
      document.querySelector("#nCaracteres").textContent=length+"/1000"
    }
    


  })

  function obtenerTarifas(){
    $.post( "controller/contactos.php",{action:"getTarifas"},
    function(data) { 
      tarifas=JSON.parse(data);
    });
  }


  function rellenarModal(id){
    $.post( "controller/contactos.php",{action:"cargarModalIniciarConsulta",id:id},
    function(data) { 
      data=JSON.parse(data);
      document.querySelector("#tarifas").innerHTML="";
      document.querySelector("#avatar").style.backgroundImage='none';
      document.querySelector("#avatar").textContent="";
      document.querySelector("#pseudonimo").textContent=""
      document.querySelector("#estado").innerHTML=""
      id_tar=data[0];
      
      document.querySelector("#pseudonimo").textContent=data[1]
      if(data[2]!=null){
        let url="https://suerteya.com/fotosprof/"+data[2]+".jpg";
        document.querySelector("#avatar").style.backgroundImage= 'url(' + '"' + url + '"' + ')';
        document.querySelector("#avatar").textContent="";
      }else{
        document.querySelector("#avatar").style.backgroundImage='none';
        document.querySelector("#avatar").style.background="#027f92;"
        document.querySelector("#avatar").textContent=data[1].charAt(0).toUpperCase();
      }
    
      document.querySelector("#estado").innerHTML=mostrarEstado2(data[4])

      precio=data[3];

      for(tarifa of tarifas){
        document.querySelector("#tarifas").innerHTML+="<h6>"+tarifa[2]+" caracteres: "+ Math.round((tarifa[3]*data[3]) * 100) / 100+" €</h6>";
      }
     
     
      
    });
  }


  function obtenerPrecio(car){
    for(tarifa of tarifas){
      if(tarifa[1]<=car && tarifa[2]>=car){
       return Math.round((tarifa[3]*precio) * 100) / 100;
      }
    }
  }
    
  
  
  //FUNCION QUE CARGA EL CODIGO A EJECUTAR EN EL INICIO
  function init(){  
   
    obtenerTarifas();
    datosChat(idChat);
 
    bajarMensajes();
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


