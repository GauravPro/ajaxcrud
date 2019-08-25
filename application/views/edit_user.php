<div class="form-group">
                <label for="email">Fisrtname:</label>
                <input type="text" class="form-control" id="firstname" placeholder="Enter Fisrtname" name="firstname" value="<?php echo $user[0]->firstname;?>">
              </div>
              <div class="form-group">
                <label for="pwd">Lastname:</label>
                <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname" name="lastname" value="<?php echo $user[0]->lastname;?>">
              </div>
              <div class="form-group">
                <label for="pwd">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $user[0]->email;?>">
              </div>
             
             <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="text" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo $user[0]->password;?>">
              </div>
               <div class="form-group">
                <label for="pwd">User Image:</label>
                <input type="file" class="form-control" id="fileupload1"  name="" onchange="editupload_file()">
                 <input type="hidden" class="form-control" id="user_image1"  name="user_image" value="">
              </div>