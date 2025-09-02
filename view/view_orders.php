<?php
    include_once '../commons/session.php';
    include_once '../model/order_model.php';

    $userrow=$_SESSION["user"];
    $orderObj=new Order();
    $orderResult=$orderObj->getAllOrders();

?>

<html>
<head>
    <title>view orders</title>
    <?php
        include_once "../includes/bootstrap_css_includes.php";
    ?>

    <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <?php $pageName="" ?>
        <?php include_once "../includes/header_row_includes.php"; ?>

        
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_order.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Order
                    </a>
                    <br>
                    <a href="view_orders.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Orders
                    </a>
                    <br>
                    <a href="order_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Order Reports
                    </a>
                    <br>
                    <br>
                    <br>
                    <a href="dashboard.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home"></span> &nbsp;
                       Dashboard 
                    </a>
                </ul>
            </div>

            <div class="col-md-9">
                <?php
                    if(isset($_GET['msg'])){
                        $msg=base64_decode($_GET['msg']);
                        ?>
                        <div class="row">
                            <div class="alert alert-success">
                                <?php echo $msg ?>
                            </div>
                        </div>
                        <?php
                    }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="ordertable">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($ordersrow=$orderResult->fetch_assoc()){
                                                $order_id=$ordersrow["order_id"];
                                                $order_id=base64_encode($order_id);

                                                $status="Success";
                                                if($ordersrow["status"]==0){
                                                    $status="Pending";
                                                }
                                    
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $ordersrow["order_number"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ordersrow["total"]; ?>
                                                    </td>

                                                     <td
                                                        <?php 
                                                            if($ordersrow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($ordersrow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                            <a href="view_order.php?order_id=<?php echo $order_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                          

                                                             <?php
                                                                if($ordersrow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/order_controller.php?status=success&order_id=<?php echo $order_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        success
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/order_controller.php?status=pending&order_id=<?php echo $order_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        pending
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>

                                                                                                                                                                                               
                                                            <a href="../controller/order_controller.php?status=delete&order_id=<?php echo $order_id;?>" class="btn btn-danger">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                                Delete 
                                                            </a>
                                                    </td>
                                                
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        
    </div>
    
</body>
    <script src="../js/jquery-3.7.1.js"></script>

    <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function (){
        $("#ordertable").DataTable();
        });

    </script>
</html>