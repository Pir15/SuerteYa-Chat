$(document).ready(function(){


    



    $.post( "controller/formulario.php",{action:"getPermisos"},function(data){
      data=JSON.parse(data);

      let select=document.querySelector("#select_permisos");

      for(optiondata of data){
        let option=document.createElement("option");
        option.setAttribute("value",optiondata[0])
        option.setAttribute("title",optiondata[2])
        option.textContent=optiondata[1]
        select.appendChild(option)
      }
    });

    document.querySelector("#crearUsuario").addEventListener("click",function(){
      let name=document.querySelector("#nombre").value;
      let apellidos=document.querySelector("#apellidos").value
      let email=document.querySelector("#email").value
      let user=document.querySelector("#user").value
      let passwd=document.querySelector("#passwd").value
      let tel=document.querySelector("#tel").value
      let id_per=document.querySelector("#select_permisos").value
      let avatar=document.querySelector("#upfile").files[0]


      if(avatar != undefined){
        formData= new FormData();
        if(!!avatar.type.match(/image.*/)){
          avatar=formData.append("image", avatar);
        }

      }else{
        avatar="";
      }

   
      if(name!="" && apellidos!="" && email!="" && user!="" && passwd!="" && tel!="" && id_per!=""){

        document.querySelector("#newUserForm").submit()

        // $.post( "controller/newUser.php",{action:"createNewUser",name:name,apellidos:apellidos,email:email,user:user,passwd:passwd,tel:tel,permisos:id_per,avatar:avatar},
        // function(data){

        //   if(data=="true"){
            
        //   }else{
        //     console.log(data)
        //     $("#infoLogin").text("No se ha podido insertar el usuario");
        //     $('#exampleModal').modal('show');
        //     setTimeout(function() { $('#exampleModal').modal('hide'); }, 2000);
        //   }
         
        //});


      }else{
        $("#infoLogin").text("Rellene todos los campos");
        $('#exampleModal').modal('show');
        setTimeout(function() { $('#exampleModal').modal('hide'); }, 2000);
      }

    })

    

});

function getFile() {
  document.getElementById("upfile").click();
}

function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");
  previewFile()
  event.preventDefault();
}



function previewFile() {
  var preview = document.querySelector('#avatar');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.style="background-image: url('"+reader.result+"')";
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
  
  }
}


