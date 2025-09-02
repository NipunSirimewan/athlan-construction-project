<?php
    include_once "../commons/session.php";
    include_once "../model/order_model.php";

    $userrow=$_SESSION["user"];
    $orderObj=new Order();
    $supplierResult=$orderObj->getAllSuppliers();

    $order_id=base64_decode($_GET["order_id"]);
    $orderResult=$orderObj->getOrder($order_id);
    $ordersRow=$orderResult->fetch_assoc();

    $materialResult=$orderObj->getOrderItem($order_id);


    $orderresult=$orderObj->getOrderTwo($order_id);
    $order_itemrow=$orderresult->fetch_assoc();
    


?>

<html>
<head>
    <title>view order</title>
        <?php
            include_once "../includes/bootstrap_css_includes.php";
        ?>

       
</head>
<body>
    
    <div class="container">
        <?php $pageName=""?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
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

            <form action="../controller/order_controller.php?status=add_order" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg"></div>

                        <?php if(isset($_GET["msg"])){
                            ?>
                        <div class="col-md-6 col-md-offset-3 alert alert-danger">
                            <?php echo base64_decode($_GET["msg"]); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                <div style="margin-left:130px;">

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Order Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="number" id="number" placeholder="O00001" value="<?php echo $ordersRow["order_number"]; ?>"disabled>
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-3">
                            <label class="control-label">Supplier Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <select name="supplier" id="supplier" class="form-control" required="required" disabled>
                            <option value=""></option>
                                <?php
                                    while($supplier_row=$supplierResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $supplier_row["supplier_id"];?>"
                                        <?php
                                            if($supplier_row["supplier_id"]==$ordersRow["supplier"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $supplier_row["supplier_name"];?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Order Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="date" id="date"  value="<?php echo $ordersRow["date"]; ?>"disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <br>
                    <br>

                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Material</th>
                                <th scope="col" class="text-end">Price (Rs)</th>
                                <th scope="col" class="text-end">Qty</th>
                                <th scope="col" class="text-end">Amount (Rs)</th>
                                
                            </tr>
                        </thead>

                        <tbody id="TBody">
                            <?php
                                while($material_row=$materialResult->fetch_assoc()){
                            ?>
                            <tr id="TRow" class="d-none">
                                <td>
                                    <?php 
                                    $material_id = $material_row["material"];
                                    $material_data_result=$orderObj->getMaterial($material_id);

                                    $materialData = $material_data_result->fetch_assoc();
                                    ?>
                                    <input type="text" class="form-control" value="<?php echo $materialData["material_type"];?>" disabled />
                                </td>
                                <td><input type="number" class="form-control text-end" name="price[]" id="price" onchange="Calc(this);" value="<?php echo $material_row["price"]; ?>"disabled></td>
                                <td><input type="number" class="form-control text-end" name="qty[]" id="qty" onchange="Calc(this);" value="<?php echo $material_row["qty"]; ?>"disabled></td>
                                <td><input type="number" class="form-control text-end" name="amount[]" id="amount" value="<?php echo $material_row["amount"]; ?>"disabled></td>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="col-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Total (Rs)</span>
                            <input type="number" name="total" id="total" class="form-control text-end" value="<?php echo $ordersRow["total"]; ?>"disabled>
                        </div>
                    
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    

                </div>

                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>

</body>
    <script src="../js/jquery-3.7.1.js"></script>
    <script></script>

    

</html>