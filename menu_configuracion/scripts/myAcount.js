$(document).ready(function(){


 $.post( "controller/formulario.php",{action:"getUserData",idUser:idUser},function(data){
      data=JSON.parse(data);
      data=data[0];
      document.querySelector("#id").value=data[0];
      document.querySelector("#nombre").value=data[1];
      document.querySelector("#apellidos").value=data[2];
      document.querySelector("#email").value=data[3]
      document.querySelector("#user").value=data[4]
      let perUser=data[6]
      getSelectOptions(perUser);
      let select=document.querySelector("#select_permisos");
      console.log(select.value)
      
     
      
      
      
      let tel=document.querySelector("#tel").value=data[5]
      if(data[7]!="" && data[7]!=null){
      let avatar=document.querySelector("#avatar")
      avatar.style="background-image:url(../img/avatar/"+data[7]+")"
      }

      comprobarBloqueo(per,perUser);
    });
    


function getSelectOptions(value){
    $.post( "controller/formulario.php",{action:"getPermisos2"},function(data){
      data=JSON.parse(data);

      let select=document.querySelector("#select_permisos");

      for(optiondata of data){
        let option=document.createElement("option");
        option.setAttribute("value",optiondata[0])
        option.setAttribute("title",optiondata[2])
        if(optiondata[0]==value){
          option.setAttribute("selected","")
        }
        option.textContent=optiondata[1]
        select.appendChild(option)
      }
    });
  }

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

   
      if(name!="" && apellidos!="" && email!="" && user!=""  && tel!="" && id_per!=""){

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

function comprobarBloqueo(mPermiso,uPermiso){
 
  if(mPermiso>=100){
      document.querySelector("#nombre").setAttribute("readonly","");
      document.querySelector("#apellidos").setAttribute("readonly","")
      document.querySelector("#email").setAttribute("readonly","")
      document.querySelector("#user").setAttribute("readonly","")
      document.querySelector("#passwd").setAttribute("readonly","")
      document.querySelector("#tel").setAttribute("readonly","")
      document.querySelector("#contrasena_div").style="display:none"
      document.querySelector("#select_permisos_div").style="display:none"
      document.querySelector("#crearUsuario").style="display:none"
      document.querySelector("#btnImage").style="display:none"

  }else{
    if(mPermiso<100 && mPermiso>5){
     
      if(mPermiso>uPermiso){
        document.querySelector("#nombre").setAttribute("readonly","");
        document.querySelector("#apellidos").setAttribute("readonly","")
        document.querySelector("#email").setAttribute("readonly","")
        document.querySelector("#user").setAttribute("readonly","")
        document.querySelector("#passwd").setAttribute("readonly","")
        document.querySelector("#tel").setAttribute("readonly","")
        document.querySelector("#select_permisos_div").style="display:none"
        document.querySelector("#crearUsuario").style="display:none"
        document.querySelector("#btnImage").style="display:none"
      }

      if(mPermiso<=uPermiso){

      
      document.querySelector("#user").setAttribute("readonly","")
      document.querySelector("#select_permisos_div").style="display:none"
      document.querySelector("#select_permisos").setAttribute("readonly","")
    }

    }

  }
}


