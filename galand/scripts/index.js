
$(document).ready(function(){
  
  let selector=document.querySelector("#selectorCanales");
  let btnContactos=document.querySelector("#contactosBtn");
  let menu=document.querySelector("#myTabContent");

init();


  
  
  selector.addEventListener("click",function(e){
    
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
      
      
      function init(){
        configurarBotonContactos()
      }

    
  

});