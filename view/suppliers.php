<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/supplier_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $supplierObj=new Supplier();
    $countResult=$supplierObj->getSupplierCount();
    $count_row=$countResult->fetch_assoc();


?>

<html>
    <head>
        <title>suppliers management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
    </head>

<body>
    <div class="container">
        <?php $pageName="SUPPLIER MANAGEMENT"?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_supplier.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Supplier
                    </a>
                    <br>
                    <a href="view_suppliers.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Suppliers
                    </a>
                    <br>
                    <a href="supplier_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Supplier Reports
                    </a>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-10" style="margin-left:70px;">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Suppliers</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $count_row["supplier_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
    <script src="../js/jquery-3.7.1.js"></script>
</html>