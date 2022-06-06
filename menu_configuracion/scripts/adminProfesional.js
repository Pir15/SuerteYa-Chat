$(document).ready(function(){
    $.post( "controller/adminUsers.php",{action:"getProfesionales"},function(data){
      
      var table = $('#table')
     
      data=JSON.parse(data);
      
      jsonData=[];
      for( user of data){
        let estado;
        let avatar="";
        if(user[6]=="1"){
           estado="<a href='controller/adminUsers.php?baja="+user[0]+"' class='btn btn-success'><i class='fas fa-check'></i></a>"
        }else{
           estado="<a href='controller/adminUsers.php?alta="+user[0]+"' class='btn btn-danger'><i class='fas fa-ban'></i></a>"
        }

        if(user[4]!=null && user[4]!=""){
          avatar="style='background-image:url(../img/avatar/"+user[4]+"')";
        }
       
        let json={
          'idUser': user[0],
          'nombre': "<b>("+user[1]+")</b> "+ user[2],
          'usuario': user[3],
          'avatar': "<img class='icon-image-new' "+avatar+"/>",
          'permisos': user[5],
          'edit':"<a href='myAcount.php?id="+user[0]+"' class='btn btn-info'><i class='fas fa-user-edit'></i></a>",
          'delete': "<a href='controller/adminUsers.php?delete="+user[0]+"' class='btn btn-danger'><i class='fas fa-times'></i></a>",
          'estado':estado,
        }

        jsonData.push(json)
      }
  
      table.bootstrapTable({data: jsonData})

    });


    
});

//$('#exampleModal').modal('hide');



