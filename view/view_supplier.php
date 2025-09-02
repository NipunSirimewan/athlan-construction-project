<?php
    include_once "../commons/session.php";
    include_once "../model/supplier_model.php";

    
    $supplierObj=new Supplier();
    $supplier_id=$_GET["supplier_id"];
    $supplier_id=base64_decode($_GET["supplier_id"]);
    $supplierResult=$supplierObj->getSupplier($supplier_id);
    $supplierdetailrow=$supplierResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view supplier</title>
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
                    <br>
                    <br>
                    <br>
                    <a href="dashboard.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home"></span> &nbsp;
                       Dashboard 
                    </a>
                </ul>
            </div>

            
                
                   
                    <div class="col-md-5" style="margin-left:160px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Supplier Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $supplierdetailrow["supplier_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Company Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $supplierdetailrow["company_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Supplier Email</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $supplierdetailrow["email"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contact Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $supplierdetailrow["contact_number"];?></h4>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Description</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $supplierdetailrow["description"];?></h4>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>


                    </div>

                        
                        
                        
                    
                
            
        </div>
    </div>

    
</body>

    <script src="../js/jquery-3.7.1.js"></script>

</html>