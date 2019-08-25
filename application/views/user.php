<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Module</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User Details</h2>
  <p id="msg"></p>            
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-user-modal">+Add User</button>
  <table class="table table-striped" id="tbl_user">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
         <th>User Image</th>
         <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($user as $value) {  ?>
    
      <tr>
        <td><?php echo $value->firstname;?></td>
        <td><?php echo $value->lastname;?></td>
        <td><?php echo $value->email;?></td>
        <td><img src="<?php echo base_url();?>/uploads/<?php echo $value->user_image;?>" style="height:100px;width:100px;"></td>
        <td><button type="button" class="btn btn-warning" onclick="user_editform('<?php echo $value->uid;?>')">Edit</button> | <button type="button" class="btn btn-danger" onclick="user_delete('<?php echo $value->uid;?>')">Delete</button></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>


 <!-- Add User Modal -->
  <div class="modal fade" id="add-user-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
          <form id="add-user" method="post">
            <div class="form-group">
              <label for="email">Fisrtname:</label>
              <input type="text" class="form-control" id="firstname" placeholder="Enter Fisrtname" name="firstname">
            </div>
            <div class="form-group">
              <label for="pwd">Lastname:</label>
              <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname" name="lastname">
            </div>
            <div class="form-group">
              <label for="pwd">Email:</label>
              <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
           
           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
             <div class="form-group">
              <label for="pwd">User Image:</label>
              <input type="file" class="form-control" id="fileupload"  name="" onchange="upload_file()">
               <input type="hidden" class="form-control" id="user_image"  name="user_image" value="">
            </div>
            <button type="button" class="btn btn-success" onclick="add_user()">Add</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- edit User Modal -->
  <div class="modal fade" id="edit-user-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
          <form id="edit-user" method="post">
              <input type="hidden" class="form-control" id="uid"  name="uid" value="">
            <div id="edit-form">
              
            </div>
            <button type="button" class="btn btn-success" onclick="edit_user()">Edit User</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="close1" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

</body>

<script>
   
   function upload_file(){

    var file_data= $('#fileupload').prop('files')[0];
    var form_data= new FormData(); 
    
    form_data.append('file',file_data);
     $.ajax({
      url:'<?php echo base_url('user/upload_file');?>',
      type:'post',
      data:form_data,
      processData:false,
      contentType:false,
      

      success:function(res){
         
         $('#user_image').val(res);
      }
     });

   }

   function add_user(){

     var form_data=$('#add-user').serialize();

     $.ajax({
     url:'<?php echo base_url('user/add_user')?>',
     type:'post',
     data:form_data,
     success:function(res){
       if(res=="success"){
       $("#close").click()
       $('#tbl_user').load(' #tbl_user');
       $('#msg').html('<div class="alert alert-success"><strong>Success!</strong>User Add</div>')
       $('.alert-success').fadeOut(4000);
     }else{
       $('#msg').html('<div class="alert alert-danger"><strong>Error!</strong>User Add</div>')
       $('.alert-danger').fadeOut(4000);
       }
     }
     });

   }

   function user_delete(id){
      $.ajax({
        url:'<?php echo base_url();?>/user/user_delete',
        type:'post',
        data:{ id : id},
        success: function(res){
           if(res=="success"){
          $('#tbl_user').load(' #tbl_user');
          $('#msg').html('<div class="alert alert-success"><strong>Success!</strong>User Delete</div>')
       $('.alert-success').fadeOut(4000);
        }
        } 
      });

   }

   function user_editform(id){
     $('#edit-user-modal').modal('show');
      $.ajax({
        url:'<?php echo base_url();?>/user/user_editform',
        type:'post',
        data:{ id : id},
        success: function(res){
          $('#uid').val(id);
          $('#edit-form').html(res);
        } 
      });

   }

   function editupload_file(){

    var file_data= $('#fileupload1').prop('files')[0];
    var form_data= new FormData(); 
    
    form_data.append('file',file_data);
     $.ajax({
      url:'<?php echo base_url('user/upload_file');?>',
      type:'post',
      data:form_data,
      processData:false,
      contentType:false,
      success:function(res){
         alert(res);
         $('#user_image1').val(res);
      }
     });

   }

   function edit_user(){

     var form_data=$('#edit-user').serialize();

     $.ajax({
     url:'<?php echo base_url('user/edit_user')?>',
     type:'post',
     data:form_data,
     success:function(res){
     if(res=="success"){
       $("#close1").click()
       $('#tbl_user').load(' #tbl_user');
       $('#msg').html('<div class="alert alert-success"><strong>Success!</strong>User Edit</div>')
       $('.alert-success').fadeOut(4000);
     }
     }
     });

   }


</script>
</html>

