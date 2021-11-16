<script>
  $('#update_form').on("submit", function(event) {
    event.preventDefault();
    if ($('#shoesName1').val() == '') {
      alert("Shoes Name can't be empty");
    } else if (parseInt($('#priceShoes1').val()) <= 0) {
      alert("Prize must be more than 0");
    } else if ($('#subDesc1').val() == '') {
      alert("Sub Description can't be empty");
    } else if ($('#descShoes1').val() == '') {
      alert("Description can't be empty");
    } else if (parseInt($('#sizeShoes1').val()) <= 0) {
      alert("Size must be more than 0");
    } else if (parseInt($('#stockShoes1').val()) <= 0) {
      alert("Stock must be more than 0");
    } else {
      $.ajax({
        url: "update.php",
        method: "POST",
        data: $('#update_form').serialize(),
        beforeSend: function() {
          $('#update').val("Updating");
        },
        success: function(data) {
          $('#update_form')[0].reset();
          $('#editModal').modal('hide');
          $('#tableUpdate').html(data);
        }
      });
    }
  });
</script>
<?php
if (isset($_POST["id_sepatu"])) {
  $output = '';
  require_once("../controller/connection.php");
  $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu='" . $_POST["id_sepatu"] . "'");
  $stmt->execute();
  $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  $output .= '
     <form class="form-sample dashboard_btn" method="POST" action="" enctype="multipart/form-data" id="update_form">
     <input type="hidden" name="id" id="id" value="' . $_POST["id_sepatu"] . '" class="form-control" />
     <div class="row">
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="shoesName1" class="col-sm-3 col-form-label">Shoes Name</label>
         <div class="col-sm-9">
           <input type="text" class="form-control" name="shoesName1" id="shoesName1" placeholder="Shoes Name" value="' . $sepatu[0]['nama_sepatu'] . '">
         </div>
       </div>
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="priceShoes1" class="col-sm-3 col-form-label">Price</label>
         <div class="col-sm-9">
           <input type="number" class="form-control" name="priceShoes1" id="priceShoes1" placeholder="Price" value="' . $sepatu[0]['harga_sepatu'] . '">
         </div>
       </div>
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="subDesc1" class="col-sm-3 col-form-label">Sub Description</label>
         <div class="col-sm-9">
           <textarea class="form-control" name="subDesc1" id="subDesc1" style="height: 100px;">' . $sepatu[0]['sub_desc'] . '</textarea>
         </div>
       </div>
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="descShoes1" class="col-sm-3 col-form-label">Description</label>
         <div class="col-sm-9">
           <textarea class="form-control" name="descShoes1" id="descShoes1" style="height: 100px;">' . $sepatu[0]['desc_sepatu'] . '</textarea>
         </div>
       </div>
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="sizeShoes1" class="col-sm-3 col-form-label">Size</label>
         <div class="col-sm-9">
           <input type="number" class="form-control" name="sizeShoes1" id="sizeShoes1" placeholder="Size" value="' . $sepatu[0]['size_sepatu'] . '">
         </div>
       </div>
       <div class="form-group row" style="margin-top: 0; margin-bottom: 10px;">
         <label for="stockShoes1" class="col-sm-3 col-form-label">Stock</label>
         <div class="col-sm-9">
           <input type="number" class="form-control" name="stockShoes1" id="stockShoes1" placeholder="Stock" value="' . $sepatu[0]['stock_sepatu'] . '">
         </div>
       </div>
     </div>
     <button name="update" id="update" value="Update" class="btn btn-success" style="background-color: #32aba4;">Update</button>
   </form>
     ';
  echo $output;
}
?>