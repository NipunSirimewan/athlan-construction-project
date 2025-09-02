<?php
    include_once '../commons/session.php';
    include_once '../model/supplier_model.php';

    $userrow=$_SESSION["user"];
    $supplierObj=new Supplier();

    $supplierResult=$supplierObj->getAllSuppliers();

?>

<html>
<head>
    <title>view suppliers</title>
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
                                <table class="table table-striped" id="suppliertable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Supplier Name</th>
                                            <th>Company Name</th>
                                            <th>Mobile</th>
                                            <th>&nbsp;</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($supplierrow=$supplierResult->fetch_assoc()){
                                                $supplier_id=$supplierrow["supplier_id"];
                                                $supplier_id=base64_encode($supplier_id);

                                                
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $supplierrow["supplier_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $supplierrow["company_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $supplierrow["contact_number"]; ?>
                                                    </td>
                                                   
                                                 

                                                    <td>
                                                            <a href="view_supplier.php?supplier_id=<?php echo $supplier_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_supplier.php?supplier_id=<?php echo $supplier_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>
 
                                                            <a href="../controller/supplier_controller.php?status=delete&supplier_id=<?php echo $supplier_id;?>" class="btn btn-danger">
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
        $("#suppliertable").DataTable();
        });

    </script>

</html>