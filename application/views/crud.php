<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style type="text/css">
  .error{
    color:red; 
  }
</style>
</head>
<body>

<div class="container">
  <h2>Crud Operation</h2>
  <p id="msg"></p>            
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">+ Add</button>
  <table class="table table-striped" id="tbl-user">
    <thead>
      <tr>
        <th>Profile</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($user as $value) {?>
      <tr>
        <td><img src="<?php echo base_url();?>uploads/<?php echo $value->user_image;?>" style="height::100px;width:100px;"></td>
        <td><?php echo $value->firstname;?></td>
        <td><?php echo $value->lastname;?></td>
        <td><?php echo $value->email;?></td>
         <td><button type="button" class="btn btn-warning" onclick="edit_form('<?php echo $value->uid;?>')">Edit</button>  |  <button type="button" class="btn btn-danger" onclick="delete_user('<?php echo $value->uid;?>')">Delete</button></td>
      </tr>
    <?php } ?>
     
     
    </tbody>
  </table>
</div>

</body>
 
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
         <form action="" id="add-form" method="post">
          <div class="form-group">
            <label for="email">Firstname:</label>
            <input type="text" class="form-control" id="firstname" placeholder="Enter firstname" name="firstname">
          </div>
          <div class="form-group">
            <label for="pwd">Lastname:</label>
            <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" name="lastname">
          </div>
           <div class="form-group">
            <label for="pwd">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
          </div>
           <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
          </div>
          <div class="form-group">
            <label for="pwd">Profile Image:</label>
            <input type="file" class="form-control" id="fileupload" placeholder="Enter password" name="" onchange="file_upload()">
            <input type="hidden" class="form-control" id="user_image"  name="user_image" value="">
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="add_user()">Submit</button>
          <button type="button" class="btn btn-default"  id="close" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
         <form action="" id="edit-form" method="post">
           <div id="edit-body">
             

           </div>
        
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="edit_user()">Submit</button>
          <button type="button" class="btn btn-default"  id="close" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
  
<script >
  
  function file_upload(){
     var filedata= $('#fileupload').prop('files')[0];
    var formdata = new FormData();
    formdata.append('file',filedata);

    $.ajax({
       url:'<?php echo base_url('crud/upload_file');?>',
            type:"post",
            data:formdata,
             processData:false,
             contentType:false,
            success:function(res){
               $('#user_image').val(res);
               alert(res);
            }

    });
  }

 function file_upload1(){
     var filedata= $('#fileupload1').prop('files')[0];
    var formdata = new FormData();
    formdata.append('file',filedata);

    $.ajax({
       url:'<?php echo base_url('crud/upload_file');?>',
            type:"post",
            data:formdata,
             processData:false,
             contentType:false,
            success:function(res){
               $('#user_image1').val(res);
               alert(res);
            }

    });
  }



  function add_user(){

  
   $('#add-form').validate({
     rules:{
      firstname:{
        required:true
      },
      lastname:{
        required:true
      },
      email:{
        required:true,
        email:true
      },
      password:{
        required:true
      }

     },
     messages:{
        firstname:{
        required:"enter firstname"
      },
      lastname:{
        required:"enter lastname"
      },
      email:{
        required:"enter email",
         email:"enter valid email"
      },
      password:{
        required:"enter password"
      }
     },
     submitHandler: function(form){
  
          var formdata = $('#add-form').serialize();
        
          $.ajax({
            url:'<?php echo base_url('crud/add_user');?>',
            type:"post",
            data:formdata,
            dataType:"json",
            success:function(res){
               
               if(res.response=='success'){
                $("#close").click();
                 $('#tbl-user').load(' #tbl-user');
                 $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> User Added.</div>');
                 $(".alert-success").fadeOut(4000);  
               }else{
                 $('#msg').html('<div class="alert alert-danger"><strong>Error!</strong></div>');
                 $(".alert-success").fadeOut(4000);  
               }
            }
          });
     }

   });
  }

  function delete_user(id){
    $.ajax({
      url:'<?php echo base_url('crud/delete_user');?>',
      type:'post',
      data:{ id : id},
      dataType:'json',
      success:function(res){
        if(res.response=='success'){
         
           $('#tbl-user').load(' #tbl-user');
           $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> User Delete.</div>');
           $(".alert-success").fadeOut(4000);  
         }else{
           $('#msg').html('<div class="alert alert-danger"><strong>Error!</strong></div>');
           $(".alert-success").fadeOut(4000);  
         }
      }

    });
  }

  function edit_form(id){
    $('#editModal').modal('show');
    $.ajax({
      url:'<?php echo base_url('crud/edit_form');?>',
      type:'post',
      data:{ id : id},
      success:function(res){
           $('#edit-body').html(res);
      }
    });
  }

  function edit_user(id){
     var formdata = $('#edit-form').serialize();
    $.ajax({
      url:'<?php echo base_url('crud/edit_user');?>',
      type:'post',
      data:formdata,
      dataType:'json',
      success:function(res){
        if(res.response=='success'){
         
           $('#tbl-user').load(' #tbl-user');
           $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> User Update.</div>');
           $(".alert-success").fadeOut(4000);  
         }else{
           $('#msg').html('<div class="alert alert-danger"><strong>Error!</strong></div>');
           $(".alert-success").fadeOut(4000);  
         }
      }

    });
  }
</script>


</html>