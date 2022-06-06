

    
        // function init(val){
        //   console.log(val)
        // }
    
     function init(to){
      console.log(to)
       $.post( "controller/token.php",{to:to}),function(data){
         console.log(data);
       };
     }

    // console.log("JS OK")

		   let nMensajesNotificacion=-1;
       let nMensajesTotales=0;

     
     

 function mandarNotificacion(){
    if (navigator.userAgent.indexOf("Win") != -1){
    var audio = new Audio('sounds/notification.mp3');
    audio.play()
    Push.create("SuerteYa Chat", {
      body: "Ha recibido un mensaje",
      icon: 'img/ico.jpg',
      timeout: 5000,
      onClick: function () {
          window.focus();
          this.close();
      }
  });
    }
} 


function recargar(){
  listarChat()
}


function listarChat() {
  $.post( "controller/chat.php",{action:"listarChat"},
  function(data) {
    data=JSON.parse(data);
    if(data.length>0){
    for(let i=0;i<data.length;i++) {
      nMensajesTotales+=data[i][6];
      
    }

     console.log(nMensajesTotales+" "+nMensajesNotificacion)

       if(nMensajesTotales>nMensajesNotificacion && nMensajesNotificacion!=-1){
         mandarNotificacion();
         nMensajesNotificacion=nMensajesTotales;
       }
 
       if(nMensajesNotificacion==-1){
         nMensajesNotificacion=nMensajesTotales;
       }

       nMensajesTotales=0


  } 
  },
 ); 
}




setInterval(function(){recargar()},1000);
