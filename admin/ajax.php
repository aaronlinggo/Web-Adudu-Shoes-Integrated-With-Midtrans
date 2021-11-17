<?php
    require_once('../controller/connection.php');
    $action = $_REQUEST["action"];
    
    if($action == "search"){
        $order_id = $_REQUEST["order_id"];
        if ($order_id == ""){
            $stmt = $conn->prepare("SELECT * FROM payment");
            $result = $stmt->execute();
            $payment = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            ?>
            <table class="table table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="dashboard_btn">
                    <?php foreach ($payment as $key => $value) { ?>
                        <tr>
                            <td><?= ($key+1) ?></td>
                            <td><?= $value['order_id'] ?></td>
                            <td><?= "Rp. " . number_format($value['gross_amount'], 0, ',', '.') . ",-" ?></td>
                            <td>
                                <?php 
                                    if ($value['transaction_status'] == "settlement"){
                                        echo "<button class='btn btn-success' style='cursor: default; margin:0; background-color: #34B1AA;'>Success</button>";
                                    }
                                    else if ($value['transaction_status'] == "pending"){
                                        echo "<button class='btn btn-secondary' style='cursor: default; margin:0; background-color: #d4e1ed;'>Pending</button>";
                                    }
                                    else{
                                        echo "<button class='btn btn-danger' style='cursor: default; margin:0; background-color: #F95F53;'>Expired</button>";
                                    }
                                ?>
                            </td>
                            <td>
                                <button class='btn btn-success' id="<?= $value['id'] ?>" onclick="showDetail()" style='margin:0; background-color: #34B1AA;'>Details</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
        }
        else{
            $stmt = $conn->prepare("SELECT * FROM payment where order_id = $order_id");
            $result = $stmt->execute();
            $payment = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($payment)>0){
            ?>
            <table class="table table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="dashboard_btn">
                    <?php foreach ($payment as $key => $value) { ?>
                        <tr>
                            <td><?= ($key+1) ?></td>
                            <td><?= $value['order_id'] ?></td>
                            <td><?= "Rp. " . number_format($value['gross_amount'], 0, ',', '.') . ",-" ?></td>
                            <td>
                                <?php 
                                    if ($value['transaction_status'] == "settlement"){
                                        echo "<button class='btn btn-success' style='cursor: default; margin:0; background-color: #34B1AA;'>Success</button>";
                                    }
                                    else if ($value['transaction_status'] == "pending"){
                                        echo "<button class='btn btn-secondary' style='cursor: default; margin:0; background-color: #d4e1ed;'>Pending</button>";
                                    }
                                    else{
                                        echo "<button class='btn btn-danger' style='cursor: default; margin:0; background-color: #F95F53;'>Expired</button>";
                                    }
                                ?>
                            </td>
                            <td>
                                <button class='btn btn-success' id="<?= $value['id'] ?>" onclick="showDetail()" style='margin:0; background-color: #34B1AA;'>Details</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            } 
            else {
            ?>
            <table class="table table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="dashboard_btn">
                    <tr>
                        <td colspan="5">Order ID Not Found</td>
                    </tr>
                </tbody>
            </table>
            <?php
            }
        }
    }
    else if($action == "viewAll"){
        $stmt = $conn->prepare("SELECT * FROM payment");
        $result = $stmt->execute();
        $payment = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        ?>
        <table class="table table-hover" style="text-align: center;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order ID</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="dashboard_btn">
                <?php foreach ($payment as $key => $value) { ?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $value['order_id'] ?></td>
                        <td><?= "Rp. " . number_format($value['gross_amount'], 0, ',', '.') . ",-" ?></td>
                        <td>
                            <?php 
                                if ($value['transaction_status'] == "settlement"){
                                    echo "<button class='btn btn-success' style='cursor: default; margin:0; background-color: #34B1AA;'>Success</button>";
                                }
                                else if ($value['transaction_status'] == "pending"){
                                    echo "<button class='btn btn-secondary' style='cursor: default; margin:0; background-color: #d4e1ed;'>Pending</button>";
                                }
                                else{
                                    echo "<button class='btn btn-danger' style='cursor: default; margin:0; background-color: #F95F53;'>Expired</button>";
                                }
                            ?>
                        </td>
                        <td>
                            <button class='btn btn-success' id="<?= $value['id'] ?>" onclick="showDetail()" style='margin:0; background-color: #34B1AA;'>Details</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    }
    else if($action == "showDetail"){
        $id_payment = $_REQUEST["id_payment"];

        $stmt = $conn->prepare("SELECT * FROM payment where id = $id_payment");
        $result = $stmt->execute();
        $payment_details = $stmt->get_result()->fetch_assoc();

        $stmt = $conn->prepare("SELECT * FROM order_details where payment_id = $id_payment");
        $result = $stmt->execute();
        $order_details = $stmt->get_result()->fetch_assoc();

        $id_order_details = $order_details['id_order_details'];
        $user_id = $order_details['user_id'];

        $stmt = $conn->prepare("SELECT * FROM users where id_user = $user_id");
        $result = $stmt->execute();
        $user_details = $stmt->get_result()->fetch_assoc();

        $stmt = $conn->prepare("SELECT * FROM order_items where order_id = $id_order_details");
        $result = $stmt->execute();
        $order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        ?>
        <table class="table table-hover">
            <tbody class="dashboard_btn">
                <tr>
                    <td>Order ID : <?= $payment_details['order_id'] ?></td>
                </tr>
                <tr>
                    <td>Transaction Time : <?= $payment_details['transaction_time'] ?></td>
                </tr>
                <tr>
                    <td>Status : <?php 
                                if ($payment_details['transaction_status'] == "settlement"){
                                    echo "<button class='btn btn-success' style='cursor: default; margin:0; background-color: #34B1AA;'>Success</button>";
                                }
                                else if ($payment_details['transaction_status'] == "pending"){
                                    echo "<button class='btn btn-secondary' style='cursor: default; margin:0; background-color: #d4e1ed;'>Pending</button>";
                                }
                                else{
                                    echo "<button class='btn btn-danger' style='cursor: default; margin:0; background-color: #F95F53;'>Expired</button>";
                                }
                            ?></td>
                </tr>
                <tr>
                    <td>ID User : <?= $user_details['id_user'] ?></td>
                </tr>
                <tr>
                    <td>Name : <?= $user_details['nama'] ?></td>
                </tr>
                <tr>
                    <td>Amount : <?= "Rp. " . number_format($order_details['total'], 0, ',', '.') . ",-" ?></td>
                </tr>
                <tr>
                    <td>Order Items</td>
                </tr>
                <?php foreach($order_items as $key => $value) { 
                    $sepatu_id = $value['sepatu_id'];
                    $stmt = $conn->prepare("SELECT * FROM sepatu where id_sepatu = $sepatu_id");
                    $result = $stmt->execute();
                    $sepatu = $stmt->get_result()->fetch_assoc();
                ?>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div style="width: 20%; height: 100px; margin-right: 2vh;">
                                    <img src="<?= $sepatu['link_gambarsepatu'] ?>" alt="" style="width: 100px; height: 100px;">
                                </div>
                                <div class="d-flex flex-column" style="width: 80%;">
                                    <div class="text-wrap fw-bold"><?= $value['qty'] . "x " . $sepatu['nama_sepatu'] ?></div>
                                    <div><?= "Size " . $sepatu['size_sepatu'] ?></div>
                                    <div>Price : <?= "Rp. " . number_format($sepatu['harga_sepatu'], 0, ',', '.') . ",-" ?></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
    }
?>