<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
  .error{
    color:red;
  }
</style>
</head>
<body>
<?php echo form_open_multipart('ser_val');?>

<div class="container">
  <h2>User form</h2>
  
     <div class="error">  <?php echo $error;?></div>
 
    <div class="form-group">
      <label for="email">Firstname:</label>
      <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" name="firstname" value="<?php echo set_value('firstname'); ?>" size="50">
    </div>
     <div id="firstname-error" class="error" for="firstname"><?php echo form_error('firstname'); ?></div>
    <div class="form-group">
      <label for="email">Lastname:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname" name="lastname" value="<?php echo set_value('lastname'); ?>" size="50">
    </div>
      <div id="firstname-error" class="error" for="firstname"><?php echo form_error('lastname'); ?></div>
      <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo set_value('email'); ?>" size="50">
    </div>
     <div id="firstname-error" class="error" for="firstname"><?php echo form_error('email'); ?></div>
     <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo set_value('password'); ?>" size="50">
    </div>
      <div id="firstname-error" class="error" for="firstname"><?php echo form_error('password'); ?></div>
      
      <div class="form-group">
      <label for="pwd">upload:</label>
      <input type="file" class="form-control" id="user_image"  name="user_image" value="<?php echo set_value('user_image'); ?>">
    </div>
      <div id="firstname-error" class="error" for="firstname"><?php echo form_error('user_image'); ?></div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>