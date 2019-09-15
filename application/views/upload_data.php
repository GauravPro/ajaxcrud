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
   
   #error{
    color:red;
   }

   .error{
    color:red;
   }
 </style>
</head>
<body>

<div class="container">
  <h2>Upload Data</h2>
  <center> <p id="error"></p></center>
  <form action="" id="upload_data" method="post">
    <div class="form-group">
      <label for="email">Firstname:</label>
      <input type="text" class="form-control" id="firstname"  placeholder="Enter firstname" name="firstname">
    </div>
     <div id="firstname-error" class="error" for="firstname"></div>
     <div class="form-group">
      <label for="email">Lastname:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" name="lastname">
    </div>
     <div id="lastname-error" class="error" for="firstname"></div>
     <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
     <div id="email-error" class="error" for="firstname"></div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
     <div id="password-error" class="error" for="firstname"></div>
     <div class="form-group">
      <label for="pwd">uplaod image:</label>
      <input type="file" class="form-control" id="user_image" placeholder="Enter password" name="user_image">
    </div>
   
    <button type="submit" class="btn btn-default" onclick="upload_data()" >Submit</button>
  </form>
</div>

</body>
<script>
  
// $('#upload_data').submit(function(e){
//     e.preventDefault(); 
//     $('#upload_data').validate({
//         rules:{
//           firstname:{
//             required:true
//           }
//         },
//         messages:{
//            firstname:{
//              required:"Enter a Firstname.."
//           }
//         },
//         submitHandler:function(form){
//           $.ajax({
//             url:'<?= base_url('upload')?>',
//             type:"post",
//             data:new FormData(form),
//             dataType: "json",
//             processData:false,
//             contentType:false,
//             success:function(res){
//                $('#error').html(res.status);
//             }
//            }); 
//         }
//     });
//  });  

function upload_data(){

   $('#upload_data').validate({
        rules:{
          firstname:{
            required:true
          }
          // ,
          //  lastname:{
          //   required:true
          // },
          //  email:{
          //   required:true
          // },
          //  password:{
          //   required:true
          // },
          // user_image:{
          //   required:true
          // }

        },
        messages:{
           firstname:{
             required:"Enter a Firstname.."
          }
          // ,
          //   lastname:{
          //    required:"Enter a Lastname.."
          // },
          //   email:{
          //    required:"Enter a Email.."
          // },
          //   password:{
          //    required:"Enter a Password.."
          // },
          //   user_image:{
          //    required:"Plz Select image.."
          // }
        },
        submitHandler:function(form){
          $.ajax({
            url:'<?=base_url('upload')?>',
            type:"post",
            data:new FormData(form),
            dataType: "json",
            processData:false,
            contentType:false,
            success:function(res){
                if(res.form_error==2)
               {
               $('#error').html(res.status);
                $('#lastname-error').html('');
               $('#lastname-error').html('');
               $('#email-error').html('');
               $('#password-error').html('');
                }
               if(res.form_error==1)
               {
               $('#lastname-error').html(res.lastname_error);
               $('#lastname-error').html(res.lastname_error);
               $('#email-error').html(res.email_error);
               $('#password-error').html(res.password_error);
             }
            }
           }); 
        }
    });

}


</script>

</html>