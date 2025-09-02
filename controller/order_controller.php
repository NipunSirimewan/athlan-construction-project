<?php
include '../commons/session.php';
if (!isset($_GET["status"])) {
    ?>
    <script>
        window.location = "../view/login.php";
    </script>
    <?php
}

$status = $_GET["status"];

include '../model/order_model.php';
include '../model/login_model.php';
$orderObj = new Order();
$loginObj = new Login();

switch ($status) {


    case "add_order":
        $number = $_POST["number"];
        $supplier = $_POST["supplier"];
        $date = $_POST["date"];


        $materials = $_POST['material'];
        $prices = $_POST['price'];
        $quantities = $_POST['qty'];
        $amounts = $_POST['amount'];
        $total=$_POST["total"];


        try {
            


            $order_id = $orderObj->addOrder($number, $supplier, $date, $total);


            if ($order_id > 0) {

                for ($i = 0; $i < count($materials); $i++) {
                    $material_id = $materials[$i];
                    $price = $prices[$i];
                    $qty = $quantities[$i];
                    $amount = $amounts[$i];

                    $orderObj->addOrderItem($order_id, $material_id, $price, $qty, $amount);

                }


                $msg = "Order Number $number successfully added!!!";
                $msg = base64_encode($msg);
                ?>
                <script>
                    window.location = "../view/view_orders.php?msg=<?php echo $msg ?>";
                </script>
                <?php
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/add_order.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;


    case "delete":
        $order_id = $_GET["order_id"];
        $order_id = base64_decode($order_id);
        $orderObj->deleteOrder($order_id);
        $msg = "Successfully Deleted!!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_orders.php?msg=<?php echo $msg; ?>";
        </script>
        <?php

        break;


        case "success":
                $order_id=$_GET["order_id"];
                $order_id=base64_decode($order_id);
                $orderObj->successorder($order_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_orders.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "pending":
                $order_id=$_GET["order_id"];
                $order_id=base64_decode($order_id);
                $orderObj->pendingorder($order_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_orders.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;



    
}