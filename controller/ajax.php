<?php
require_once("./connection.php");
$action = $_REQUEST["action"];
if ($action == "tambah") {
    $id = $_REQUEST["id"];
    $action = $_REQUEST["action"];
    $id_user = $_REQUEST["id_user"];
    $stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = $id_user");
	$stmt -> execute();
	$u = $stmt -> get_result() -> fetch_assoc();
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE id_cart=$id");
    $stmt->execute();
    $cart = $stmt->get_result()->fetch_assoc();

    $id_sepatu = $cart['sepatu_id'];

    $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$id_sepatu");
    $stmt->execute();
    $sepatu = $stmt->get_result()->fetch_assoc();

    $qty = ($cart['qty'] + 1);

    if ($sepatu['stock_sepatu'] - $qty <= 0) {
        $qty = $sepatu['stock_sepatu'];
    }

    if ($qty >= 9) {
        $qty = 9;
    }
    $result = $conn->query("update cart_item set qty = '$qty' where id_cart = $id");
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
    $stmt->execute();
    $cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
    <div class="inner flex flex-column w-100">
        <?php
        $amount = 0;
        $item_details = array();

        foreach ($cart_item as $key => $value) {
            $amount += ($value['price'] * $value['qty']);
        ?>
            <div class="cart-card flex flex-column border-radius-medium p-3">
                <?php
                $sepatu_id = $value['sepatu_id'];

                $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu = $sepatu_id");
                $stmt->execute();
                $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if (strlen($sepatu[0]['nama_sepatu']) > 25) {
                    $nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
                } else {
                    $nama_sepatu = $sepatu[0]['nama_sepatu'];
                }

                $item1_details = array(
                    'id' => $sepatu_id,
                    'price' => $value['price'],
                    'quantity' => $value['qty'],
                    'name' => $nama_sepatu
                );
                array_push($item_details, $item1_details);
                ?>
                <div class="flex-center flex-vstart w-100">
                    <img src='../../admin/<?= $sepatu[0]['link_gambarsepatu'] ?>' alt="" class="cart-img border-radius-medium" width="80px" height="80px">
                    <div class="cart-info flex-center flex-vstart flex-column w-100">
                        <div class="payment-text flex flex-vcenter" style="font-weight: 600;">
                            <?= $sepatu[0]['nama_sepatu'] ?>
                        </div>
                        <div class="payment-text flex flex-vcenter">
                            Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($value['price'], 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
                <div class="flex-center flex-hend flex-wrap-reverse" style="padding-top: 36px;">
                    <div class="cart-control flex-center">
                        <div class="margin-right left">
                            <a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
                                <button class="btn btn-dark">Details</button>
                            </a>
                        </div>
                        <form action="" method="POST" class="margin-right right">
                            <input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
                            <button class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </div>
                    <div class="cart-control-bottom flex-center">
                        <div class="child-container subtotal flex-center">
                            <span class="flex-center" style="font-weight: 600; margin: 0 8px;">
                                Subtotal: Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format(($value['price'] * $value['qty']), 0, ',', '.') ?></span>
                            </span>
                        </div>
                        <div class="child-container flex-center">
                            <button class="qty btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
                            <input type="text" name="totqty" id="totqty" class="cart-textbox" value="<?= $value['qty'] ?>" readonly>
                            <button class="qty btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div id="payment-box" class="flex">
        <div class="payment-inner border-radius-medium">
            <div class="payment-text flex-center flex-between pb-3">
                <span>Total Harga:</span>
                <span><?= "Rp. " . number_format($amount, 0, ',', '.') ?></span>
            </div>
            <div class="w-100">
                <form style="margin: 0;" method="POST">
                    <input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
                    <input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
                    <input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
                    <button class="btn btn-success w-100" id="pay-button" name="payment">Pay</button>
                </form>
            </div>
        </div>
    </div>
    <?php
} else if ($action == "kurang") {
    $id = $_REQUEST["id"];
    $action = $_REQUEST["action"];
    $id_user = $_REQUEST["id_user"];
    $stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = $id_user");
	$stmt -> execute();
	$u = $stmt -> get_result() -> fetch_assoc();
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE id_cart=$id");
    $stmt->execute();
    $cart = $stmt->get_result()->fetch_assoc();

    $qty = ($cart['qty'] - 1);

    if ($qty <= 1) {
        $qty = 1;
    }
    $result = $conn->query("update cart_item set qty = '$qty' where id_cart = $id");
    $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
    $stmt->execute();
    $cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    ?>
    <div class="inner flex flex-column w-100">
        <?php
        $amount = 0;
        $item_details = array();

        foreach ($cart_item as $key => $value) {
            $amount += ($value['price'] * $value['qty']);
        ?>
            <div class="cart-card flex flex-column border-radius-medium p-3">
                <?php
                $sepatu_id = $value['sepatu_id'];

                $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu = $sepatu_id");
                $stmt->execute();
                $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if (strlen($sepatu[0]['nama_sepatu']) > 25) {
                    $nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
                } else {
                    $nama_sepatu = $sepatu[0]['nama_sepatu'];
                }

                $item1_details = array(
                    'id' => $sepatu_id,
                    'price' => $value['price'],
                    'quantity' => $value['qty'],
                    'name' => $nama_sepatu
                );
                array_push($item_details, $item1_details);
                ?>
                <div class="flex-center flex-vstart w-100">
                    <img src='../../admin/<?= $sepatu[0]['link_gambarsepatu'] ?>' alt="" class="cart-img border-radius-medium" width="80px" height="80px">
                    <div class="cart-info flex-center flex-vstart flex-column w-100">
                        <div class="payment-text flex flex-vcenter" style="font-weight: 600;">
                            <?= $sepatu[0]['nama_sepatu'] ?>
                        </div>
                        <div class="payment-text flex flex-vcenter">
                            Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($value['price'], 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
                <div class="flex-center flex-hend flex-wrap-reverse" style="padding-top: 36px;">
                    <div class="cart-control flex-center">
                        <div class="margin-right left">
                            <a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
                                <button class="btn btn-dark">Details</button>
                            </a>
                        </div>
                        <form action="" method="POST" class="margin-right right">
                            <input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
                            <button class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </div>
                    <div class="cart-control-bottom flex-center">
                        <div class="child-container subtotal flex-center">
                            <span class="flex-center" style="font-weight: 600; margin: 0 8px;">
                                Subtotal: Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format(($value['price'] * $value['qty']), 0, ',', '.') ?></span>
                            </span>
                        </div>
                        <div class="child-container flex-center">
                            <button class="qty btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
                            <input type="text" name="totqty" id="totqty" class="cart-textbox" value="<?= $value['qty'] ?>" readonly>
                            <button class="qty btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div id="payment-box" class="flex">
        <div class="payment-inner border-radius-medium">
            <div class="payment-text flex-center flex-between pb-3">
                <span>Total Harga:</span>
                <span><?= "Rp. " . number_format($amount, 0, ',', '.') ?></span>
            </div>
            <div class="w-100">
                <form style="margin: 0;" method="POST">
                    <input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
                    <input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
                    <input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
                    <button class="btn btn-success w-100" id="pay-button" name="payment">Pay</button>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>