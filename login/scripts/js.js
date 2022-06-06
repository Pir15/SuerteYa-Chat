$(document).ready(function(){

  let acceder=$("#acceder")
  

  acceder.click(function(){
    let user=$("#user").val();
    let passwd=$("#passwd").val();
    if(user=="" || passwd==""){
        $("#infoLogin").text("Rellene todos los campos");
        $('#exampleModal').modal('show');
        setTimeout(function() { $('#exampleModal').modal('hide'); }, 2000);
    }else{
      $.post( "controller/login.php",{ user : user , passwd : passwd},
      function(data) {
          console.log(data)
           if(data!="OK"){
            $("#infoLogin").text("Error al realizar el Login. Compruebe los datos");
            $('#exampleModal').modal('show');
            setTimeout(function() { $('#exampleModal').modal('hide'); }, 2000);
           }else{
            window.location.replace("../index.php");
           }
        },
      ); 
    }
  })
});