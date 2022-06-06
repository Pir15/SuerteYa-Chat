$(document).ready(function(){

    arrayID=new Array()
    arrayUserName= new Array();

    function listarContactos(){
        $.post( "controller/contactos.php",{action:"listarContactos2"},
        function(data) { 
        data=JSON.parse(data);
          
        for(let contacto of data){
          if(contacto[2]<100){
            arrayID.push(contacto[0]);
            arrayUserName.push(contacto[1]);
          }
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

        let avatar=document.querySelector("#upfile").files[0]


        if(avatar != undefined){
          formData= new FormData();
          if(!!avatar.type.match(/image.*/)){
            avatar=formData.append("image", avatar);
          }
  
        }else{
          avatar="";
        }
       
        if(name!="" && result.length>0){

            
          document.querySelector("#newGroupForm").submit();
            // $.post( "controller/contactos.php",{action:"newGroup",nombre:name,userList:result,avatar:avatar},function(data){
            //   console.log(data)
            //     //window.open("chat.php?idChat="+btoa(data),"_self");
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



