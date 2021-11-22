<?php
    session_start();
    require_once("./controller/connection.php");

    if(isset($_REQUEST['id_sepatu'])) {
        $id_sepatu = (int)$_REQUEST['id_sepatu'];
        $qty = (int)$_REQUEST['qty'];
        $stmt = $conn -> prepare("SELECT * FROM sepatu WHERE id_sepatu = $id_sepatu");
        $stmt -> execute();
        $sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    
        $id_user = $_SESSION['active'];
        $active = true;
        $price = $sepatu[0]['harga_sepatu'];

        $stmt = $conn -> prepare("SELECT * FROM cart_item WHERE user_id = $id_user AND active = 1");
        $stmt -> execute();
        $checking = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        $ada = false;

        foreach($checking as $key => $value) {
            if($value['sepatu_id'] == $id_sepatu) {
                $ada = true;
                $temp = $value['qty'];
                $temp += $qty;
                if ($temp >= 9){
                    $temp = 9;
                }
                $result = $conn->query("update cart_item set qty = '$temp' where user_id = $id_user and sepatu_id = $id_sepatu");
            }
        }

        if(!$ada) {
            $stmt = $conn -> prepare("INSERT INTO cart_item(user_id, sepatu_id, qty, price, active) VALUES(?,?,?,?,?)");
            $stmt -> bind_param("iiiii", $id_user, $id_sepatu, $qty, $price, $active);
            $result = $stmt -> execute();
        }
    } else {
        echo "<script>window.location = './shoes.php';</script>";
    }
?>
