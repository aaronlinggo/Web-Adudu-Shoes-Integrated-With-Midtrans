<?php
require_once("./connection.php");
$action = $_REQUEST["action"];
if ($action == "tambah") {
    $id = $_REQUEST["id"];
    $action = $_REQUEST["action"];
    $id_user = $_REQUEST["id_user"];
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE id_cart=$id");
    $stmt->execute();
    $cart = $stmt->get_result()->fetch_assoc();

    $id_sepatu = $cart['sepatu_id'];

    $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$id_sepatu");
    $stmt->execute();
    $sepatu = $stmt->get_result()->fetch_assoc();

    $qty = ($cart['qty'] + 1);

    if ($sepatu['stock_sepatu'] - $qty <= 0){
        $qty = $sepatu['stock_sepatu'];
    }

    if ($qty >= 9){
        $qty = 9;
    }
    $result = $conn->query("update cart_item set qty = '$qty' where id_cart = $id");
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
    $stmt->execute();
    $cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $amount = 0;
    $item_details = array();
    foreach ($cart_item as $key => $value) {
        $amount += ($value['price'] * $value['qty']);

?>
        <tr>
            <td><?= ($key + 1) ?>
            </td>
            <td>
                <?php
                $sepatu_id = $value['sepatu_id'];

                $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$sepatu_id");
                $stmt->execute();
                $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (strlen($sepatu[0]['nama_sepatu']) > 25)
                    $nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
                else {
                    $nama_sepatu = $sepatu[0]['nama_sepatu'];
                }
                $item1_details = array(
                    'id' => $sepatu_id,
                    'price' => $value['price'],
                    'quantity' => $value['qty'],
                    'name' => $nama_sepatu
                );

                array_push($item_details, $item1_details);

                echo $sepatu[0]['nama_sepatu'];
                ?>
            </td>
            <td><?= "Rp. " . number_format($value['price'], 0, ',', '.') . ",-" ?></td>
            <td class="d-flex justify-content-center">
                <button class="btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
                <input type="text" name="" id="" class="form-control" style="width: 35px;" value="<?= $value['qty'] ?>">
                <button class="btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
            </td>
            <td><?= "Rp. " . number_format(($value['price'] * $value['qty']), 0, ',', '.') . ",-" ?></td>
            <td>
                <div class="d-flex justify-content-center">
                    <div style="margin-right: 1vh;">
                        <a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
                            <button class="btn btn-success">Details</button>
                        </a>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
                        <button class="btn btn-danger" name="delete">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php  } ?>
    <tr class="bg-secondary text-white align-self-center">
        <td colspan="4">
            <div style="float: right;">
                Subtotal :
            </div>
        </td>
        <td>
            <?= "Rp. " . number_format($amount, 0, ',', '.') . ",-" ?>
        </td>
        <td>
            <form style="margin: 0;">
                <input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
                <input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
                <input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
                <button class="btn btn-success" id="pay-button" name="payment">Payment</button>
            </form>
        </td>
    </tr>
<?php
}
else if ($action == "kurang") {
    $id = $_REQUEST["id"];
    $action = $_REQUEST["action"];
    $id_user = $_REQUEST["id_user"];
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE id_cart=$id");
    $stmt->execute();
    $cart = $stmt->get_result()->fetch_assoc();

    $qty = ($cart['qty'] - 1);
    
    if ($qty <= 1){
        $qty = 1;
    }
    $result = $conn->query("update cart_item set qty = '$qty' where id_cart = $id");
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
    $stmt->execute();
    $cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $amount = 0;
    $item_details = array();
    foreach ($cart_item as $key => $value) {
        $amount += ($value['price'] * $value['qty']);

?>
        <tr>
            <td><?= ($key + 1) ?>
            </td>
            <td>
                <?php
                $sepatu_id = $value['sepatu_id'];

                $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$sepatu_id");
                $stmt->execute();
                $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (strlen($sepatu[0]['nama_sepatu']) > 25)
                    $nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
                else {
                    $nama_sepatu = $sepatu[0]['nama_sepatu'];
                }
                $item1_details = array(
                    'id' => $sepatu_id,
                    'price' => $value['price'],
                    'quantity' => $value['qty'],
                    'name' => $nama_sepatu
                );

                array_push($item_details, $item1_details);

                echo $sepatu[0]['nama_sepatu'];
                ?>
            </td>
            <td><?= "Rp. " . number_format($value['price'], 0, ',', '.') . ",-" ?></td>
            <td class="d-flex justify-content-center">
                <button class="btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
                <input type="text" name="" id="" class="form-control" style="width: 35px;" value="<?= $value['qty'] ?>">
                <button class="btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
            </td>
            <td><?= "Rp. " . number_format(($value['price'] * $value['qty']), 0, ',', '.') . ",-" ?></td>
            <td>
                <div class="d-flex justify-content-center">
                    <div style="margin-right: 1vh;">
                        <a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
                            <button class="btn btn-success">Details</button>
                        </a>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
                        <button class="btn btn-danger" name="delete">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php  } ?>
    <tr class="bg-secondary text-white align-self-center">
        <td colspan="4">
            <div style="float: right;">
                Subtotal :
            </div>
        </td>
        <td>
            <?= "Rp. " . number_format($amount, 0, ',', '.') . ",-" ?>
        </td>
        <td>
            <form style="margin: 0;">
                <input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
                <input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
                <input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
                <button class="btn btn-success" id="pay-button" name="payment">Payment</button>
            </form>
        </td>
    </tr>
<?php
}
?>