<?php
if(!empty($_POST))
{
  require_once("../controller/connection.php");
  $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu='".$_POST["id"]."'");
  $stmt->execute();
  $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $shoesName = $_POST["shoesName1"];
  $priceShoes = $_POST["priceShoes1"];
  $subDesc = $_POST["subDesc1"];
  $descShoes = $_POST["descShoes1"];
  $sizeShoes = $_POST["sizeShoes1"];
  $stockShoes = $_POST["stockShoes1"];
  $result = $conn->query("update sepatu set nama_sepatu = '$shoesName', harga_sepatu = '$priceShoes', sub_desc ='$subDesc', desc_sepatu='$descShoes', size_sepatu = '$sizeShoes', stock_sepatu = '$stockShoes' where id_sepatu = '$_POST[id]'");
  $stmt = $conn->prepare("SELECT * FROM sepatu");
  $stmt->execute();
  $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<table class="table table-hover" style="text-align: center;">
  <thead>
    <tr>
      <th>Shoes ID</th>
      <th>Name</th>
      <th>Size</th>
      <th>Stock</th>
      <th>Harga</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sepatu as $key => $value) { ?>
      <tr>
        <td><?= $value['id_sepatu'] ?></td>
        <td><?= $value['nama_sepatu'] ?></td>
        <td><?= $value['size_sepatu'] ?></td>
        <td><?= $value['stock_sepatu'] ?></td>
        <td><?= "Rp. " . number_format($value['harga_sepatu'], 0, ',', '.') . ",-" ?></td>
        <td>
          <div class="d-flex">
            <form action="">
              <button class="btn btn-success edit_data" name="edit" id="<?= $value['id_sepatu'] ?>">Edit</button>
            </form>
            <form action="" method="post">
              <input type="hidden" name="id_sepatu" value="<?= $value['id_sepatu'] ?>">
              <button class="btn btn-danger" name="delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php
}
?>