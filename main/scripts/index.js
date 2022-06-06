
$(document).ready(function(){
  
  let selector=document.querySelector("#selectorCanales");
  let btnContactos=document.querySelector("#contactosBtn");
  let menu=document.querySelector("#myTabContent");
 console.log(lsc)
  switch (lsc) {
    case "0":
        if(document.querySelector("#oficina-tab")!==null){
        document.querySelector("#oficina-tab").classList.add("active");
        document.querySelector("#oficina-tab").setAttribute("aria-selected","true")
        document.querySelector("#oficina").classList.add("show","active");
        }
        if(document.querySelector("#suerteya-tab")!==null){
        document.querySelector("#suerteya-tab").classList.add("active");
        document.querySelector("#suerteya-tab").setAttribute("aria-selected","true")
        document.querySelector("#suerteya").classList.add("show","active");
        }
        break;
    case "18":
        document.querySelector("#ventanilla-tab").classList.add("active");
        document.querySelector("#ventanilla-tab").setAttribute("aria-selected","true")
        document.querySelector("#ventanilla").classList.add("show","active");
        break;
    case "19":
        document.querySelector("#centralita-tab").classList.add("active");
        document.querySelector("#centralita-tab").setAttribute("aria-selected","true")
        document.querySelector("#centralita").classList.add("show","active");
        break;
    case "21":
        document.querySelector("#tecnico-tab").classList.add("active");
        document.querySelector("#tecnico-tab").setAttribute("aria-selected","true")
        document.querySelector("#tecnico").classList.add("show" ,"active");
        break;
    case "187":
        document.querySelector("#admin-tab").classList.add("active");
        document.querySelector("#admin-tab").setAttribute("aria-selected","true")
        document.querySelector("#admin").classList.add("show","active");
        break;
}

  

init();

function setLeido(tab){
    let tabId
    //console.log(tab)
    switch (tab) {
        case "oficina-tab":
           tabId="";
            break;
        case "ventanilla-tab":
            tabId="18";
            break;
        case "centralita-tab":
          tabId="19";
            break;
        case "tecnico-tab":
          tabId="21";
            break;
        case "admin-tab":
          tabId="187";
            break;
        case "suerteya-tab":
          tabId="";
            break;
    }
    console.log(tabId);
        $.post( "controller/mensajes.php",{action:"setAllLeido",user:tabId},function(data){
            console.log(data);
            location.reload();
       
        //  var enviar = {'type':'mensajeLeido','idChat':idChat,'idUsers':usuariosChat}; //lo guardamos en un array
        //            conn.send(JSON.stringify(enviar));//enviamos el array atraves de json
        // });  
});
}


  
  
  selector.addEventListener("click",function(e){
      
    let canalesList=document.querySelectorAll(".canal");
    for (let i=0; i<canalesList.length; i++){
        
    }
    
    setTimeout(function(){
        
      configurarBotonContactos()
    },200);
  });

    function getPestañaChat(){
      if (menu.hasChildNodes()) {
        var children = menu.childNodes;
        for (var i = 0; i < children.length; i++) {
          if(i%2!=0){
            // console.log(children[i].classList.contains("active"))
            if(children[i].classList.contains( 'active' )){
              return children[i].id;
            }
          }
        }
       }
      }

      function configurarBotonContactos(){
        let selected=getPestañaChat();
       
        btnContactos.href="contactos.php?chn="+btoa(selected);
      }


      
      selector.addEventListener('mousedown',function(e){

        mousedownTab(e)
    });

      selector.addEventListener('mouseup',function(){
        mouseupTab()
      })


      selector.addEventListener('touchstart',function(e){

        mousedownTab(e)
    });

      selector.addEventListener('touchend',function(){
        mouseupTab()
      })


      function mousedownTab(e){
        start = Date.now();
        sTimeout = setTimeout(function(){
        let tab;

         if(e.target.tagName=="BUTTON"){
            tab=e.target.id
         }

         if(e.target.tagName=="DIV"){
             //console.log(e.target)
            tab=e.target.parentNode.id
         }

         if(e.target.tagName=="I"){
            tab=e.target.parentNode.id
         }
         //location.reload();

         setLeido(tab)

      },2000)
      }

      function mouseupTab(){
        end = Date.now();
        elapse = end - start
        if(elapse < 2000){
          clearTimeout(sTimeout);
        } 
      }
      
      
      function init(){
        configurarBotonContactos()
       
      }


      function mostrarTag(){

        let canalesList=document.querySelectorAll(".canal");
        for (let i=0; i<canalesList.length; i++){
              if(canalesList[i].classList.contains('active')){
                 
               canalesList[i].childNodes[3].className="d-md-inline-block";
               
              }else{
                  canalesList[i].childNodes[3].className="d-none d-md-inline-block";
              }
        }
      }

    
  

});