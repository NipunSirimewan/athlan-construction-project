<?php
    include_once "../commons/session.php";
    include_once "../model/supplier_model.php";

    $userrow=$_SESSION["user"];
    $supplierObj=new Supplier();
    


?>

<html>
<head>
    <title>add supplier</title>
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

            <form action="../controller/supplier_controller.php?status=add_supplier" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">Supplier Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="sname" id="sname">
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-3">
                            <label class="control-label">Company Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="cname" id="cname">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Supplier Email</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-3">
                            <label class="control-label">Contact Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="cnumber" id="cnumber">
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3" >
                            <label class="control-label">Description</label>
                        </div>
                        <div class="col-md-3" style="width:540px;">
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:125px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
                    </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>

</body>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/suppliervalidation.js"></script>

</html>