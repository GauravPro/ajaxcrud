<!DOCTYPE html>
<html lang="en">
<head>
  <title>E_Commerece</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Product Module</h2>
  <p id="msg"></p>            
 <br>
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
  <br>
  <table  id="tblproduct" class="table table-striped">
    <thead>
      <tr>
        <th>#ID</th>
        <th>Prodcut Image</th>
        <th>Prodcut Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action<th>
      </tr>
    </thead>
    <tbody>
    <?php $i=1; $product=$this->product_model->get_data('tbl_product');
         foreach($product as $value) {?>
      <tr>
        <td><?php echo $i?></td>
        <td><img src="<?php echo base_url()?>uploads/<?php echo $value->product_image; ?>" style="height:100px;width:100px; "></td>
        <td><?php echo $value->product_name;?></td>
        <td><?php echo $value->qauntity;?></td>
        <td><?php echo $value->price;?></td>
        <td><button type="button" class="btn btn-warning" onclick="editform('<?php echo $value->prodcut_id;?>')" >Edit</button> |
            <button type="button" class="btn btn-danger" onclick="delete_prodcut('<?php echo $value->prodcut_id;?>')">Delete</button>
          </td>
        <?php $i++;  } ?>
      </tr>
    </tbody>
  </table>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
         <form  id="add_product" method="post">
            
            <div class="form-group">
              <label for="pwd">Product Name</label>
              <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="  product_name">
            </div>
            <div class="form-group">
              <label for="email">Qauntity</label>
              <input type="text" class="form-control" id="qauntity" placeholder="Enter quantity" name="qauntity">
            </div>
            <div class="form-group">
              <label for="email">Price</label>
              <input type="text" class="form-control" id="price" placeholder="Enter price" name="price">
            </div>
            <div class="form-group">
              <label for="email">Product Image</label>
              <input type="file" class="form-control" id="product_image" placeholder="Enter email" name="" onchange="uplaod_image()">
              <input type="hidden" class="form-control" id="fileproduct_image" placeholder="Enter email" name="product_image" value="">
               <span id="filemsg"></span>
            </div>
            <button type="button" class="btn btn-success" onclick="add_product()">Add </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

   <!-- Edit Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
         <form  id="edit_product" method="post">
            <input type="hidden" class="form-control" id="prodcut_id" name="prodcut_id" value="">
            <div id="editform">
              

            </div>
         <button type="button" class="btn btn-success" onclick="edit_product()">Add </button>
        </form>
       </div>
        <div class="modal-footer">
          <button type="button" id="close1" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
 
</body>
</html>

<script>
   function add_product(){
    
    var formdata = $('#add_product').serialize();
    $.ajax({
      
      url:'<?php echo base_url()?>product/add_product',
      data:formdata,
      type:'post',
      success:function(res){
          $("#close").trigger('click');
            $('.modal-backdrop').remove();
           $('#add_product')[0].reset();
          $('#msg').html('<div class="alert alert-success">Product Add</div>');
           $(".alert-success").fadeOut(3000);
           $('#tblproduct').load(' #tblproduct');
      }

    });
   }

 //function for  document upload
function uplaod_image() {
   
   
    var x = document.getElementById("product_image");
    var form_data = new FormData();
    for(var i = 0; i < x.files.length; i++)
      {
        form_data.append('file[]', document.getElementById('product_image').files[i]);
       
      }
    
    $.ajax({
        url: '<?php echo base_url()?>product/uplaod_image',
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
         beforeSend: function(data) {

            $('#filemsg').html('<div class="alert alert-primary">In Progresss....</div>');
            $('#filemsg').show();
        },
        complete: function(data){
           $('#filemsg').html('<div class="alert alert-success">Complete</div>');
           $(".alert-success").fadeOut(3000);
           $('#filemsg').show();
        },
        success: function(res) {
              alert(res);  
             $("#fileproduct_image").val(res);
            //$('#doc-img').attr('src', SITEROOT+'uploads/'+res);
             
        }
    });
}

 //function for  document upload
function edituplaod_image() {
   
   
    var x = document.getElementById("product_image1");
    var form_data = new FormData();
    for(var i = 0; i < x.files.length; i++)
      {
        form_data.append('file[]', document.getElementById('product_image1').files[i]);
       
      }
    
    $.ajax({
        url: '<?php echo base_url()?>product/uplaod_image',
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
         beforeSend: function(data) {

            $('#filemsg').html('<div class="alert alert-primary">In Progresss....</div>');
            $('#filemsg').show();
        },
        complete: function(data){
           $('#filemsg').html('<div class="alert alert-success">Complete</div>');
           $(".alert-success").fadeOut(3000);
           $('#filemsg').show();
        },
        success: function(res) {
              alert(res);  
             $("#fileproduct_image1").val(res);
            //$('#doc-img').attr('src', SITEROOT+'uploads/'+res);
             
        }
    });
}

function delete_prodcut(id){
   
   $.ajax({
    url:'<?php echo base_url();?>/product/delete_product',
    type:'post',
    data:{ id : id},
    success:function(res){
    alert(res);
       if(res=='success'){
        $('#msg').html('<div class="alert alert-success">Product delete</div>');
        $(".alert-success").fadeOut(3000);
        $('#tblproduct').load(' #tblproduct');

      }
    }
   });
}


function editform(id){
  
  $('#editModal').modal('show');
   $.ajax({
     url:'<?php echo base_url();?>/product/editform',
     type:'post',
     data:{ id:id},
     success:function(res){
       
       $('#prodcut_id').val(id);
       $('#editform').html(res);
     }
   });
}


function edit_product(){
    
    var formdata = $('#edit_product').serialize();
    $.ajax({
      
      url:'<?php echo base_url()?>product/edit_product',
      data:formdata,
      type:'post',
      success:function(res){
          $("#close1").trigger('click');
            $('.modal-backdrop').remove();
           $('#add_product')[0].reset();
          $('#msg').html('<div class="alert alert-success">Product update</div>');
           $(".alert-success").fadeOut(3000);
           $('#tblproduct').load(' #tblproduct');
      }

    });
   }


   //function for  document upload
function upload_documents() {
    var file_data = $('#uploadfile').prop('files')[0];
    var form_data = new FormData();
  
    form_data.append('file', file_data);
    $.ajax({
        url: SITEROOT + "enquiry/form_task/uploadDocument",
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function(data) {

            $('#progressLoginLoader').html('<div class="alert alert-primary">In Progresss....</div>');
            $('#progressLoginLoader').show();
        },
        complete: function(data){
          $('#progressLoginLoader').html('<div class="alert alert-success">Complete</div>');
          $(".alert-success").fadeOut(3000);
          $('#progressLoginLoader').show();
        },
        success: function(res) {
            $("#document_name").val(res);
            $('#doc-img').attr('src', SITEROOT+'uploads/'+res);
             success_alert('File uploaded Successfully');
        }
    });
}

</script>