$(document).ready(function(){

    arrayID=new Array()
    arrayUserName= new Array();

    function listarContactos(){
        $.post( "controller/contactos.php",{action:"listarContactos2"},
        function(data) { 
        data=JSON.parse(data);
    
        for(let contacto of data){
        arrayID.push(contacto[0]);
        arrayUserName.push(contacto[1]);
        }

        mostrarContactos(arrayID,arrayUserName,"");
    
        }
    ); 
    }

    function mostrarContactos(idArray,userNameArray,search){
        document.querySelector("#userList").innerHTML="";
        for(let i=0;i<idArray.length;i++){
            if(userNameArray[i].includes(search) || search==""){
            let contacto=document.createElement("option");
            contacto.textContent=userNameArray[i];
            contacto.id=idArray[i];
        document.querySelector("#userList").appendChild(contacto)}
        }
        

    }

    listarContactos();

    document.querySelector("#crearGrupo").addEventListener("click",function(){
        let name=document.querySelector("#name").value;
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
       
        if(name!="" && result.length>0){

            let image=document.querySelector("#upfile");
            

            // $.post( "controller/contactos.php",{action:"newGroup",nombre:name,userList:result},function(data){
            //     window.open("chat.php?idChat="+data,"_self");
            // })

        }else{
            $("#groupAlert").css("display", "block");
            
        }
      
    })


    document.querySelector("#close1").addEventListener("click",function(){
        $('#exampleModal').modal('hide');
    })

    document.querySelector("#close2").addEventListener("click",function(){
        $('#exampleModal').modal('hide');
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
  