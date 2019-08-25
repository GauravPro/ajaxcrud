    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


      <div class="form-group">
          <label for="pwd">Product Name</label>
          <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="product_name" value="<?php echo $product[0]->product_name?>">
        </div>
        <div class="form-group">
          <label for="email">Qauntity</label>
          <input type="text" class="form-control" id="qauntity" placeholder="Enter quantity" name="qauntity" value="<?php echo $product[0]->qauntity?>">
        </div>
        <div class="form-group">
          <label for="email">Price</label>
          <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" value="<?php echo $product[0]->price?>">
        </div>
      
       <div class="form-group">
         
          <label for="email">Product Image</label>
          <input type="file" class="form-control" id="product_image1" placeholder="Enter email" name="" onchange="edituplaod_image()">
          <input type="hidden" class="form-control" id="fileproduct_image1" placeholder="Enter email" name="product_image">
           <span id="filemsg"></span>
        </div>
        