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
                                <button class='btn btn-success' style='margin:0; background-color: #34B1AA;'>Details</button>
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
                                <button class='btn btn-success' style='margin:0; background-color: #34B1AA;'>Details</button>
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
                            <button class='btn btn-success' style='margin:0; background-color: #34B1AA;'>Details</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    }
?>