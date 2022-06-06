$(document).ready(function(){






});



function mandarNotificacion($text){
  if (navigator.userAgent.indexOf("Win") != -1){
  var audio = new Audio('sounds/notification.mp3');
  audio.play()
  window.focus();
  console.log(Push)
  Push.create("SuerteYa Chat", {
    body: $text,
    icon: 'img/ico.jpg',
    timeout: 5000,
    onClick: function () {
        window.focus();
        this.close();
    }
});
  }
}


