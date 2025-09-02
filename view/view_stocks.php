<?php
    include_once '../commons/session.php';
    include_once '../model/stock_model.php';

    $userrow=$_SESSION["user"];
    $stockObj=new Stock();
    $stockResult=$stockObj->getAllStocks();

?>

<html>
<head>
    <title>view stocks</title>
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
                    <a href="add_stock.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Stock
                    </a>
                    <br>
                    <a href="view_stocks.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Stocks
                    </a>
                    <br>
                    <a href="stock_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Stock Reports
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
                                <table class="table table-striped" id="stocktable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Type</th>
                                            <th>Available QTY</th>
                                            <th>Reorder Level</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($stockrow=$stockResult->fetch_assoc()){
                                                $stock_id=$stockrow["stock_id"];
                                                $stock_id=base64_encode($stock_id);
                                    
                                                ?>

                                                <tr>

                                                    <td>
                                                        <?php echo $stockrow["material_type"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $stockrow["available_qty"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $stockrow["reorder_level"]; ?>
                                                    </td>
                                                    
                                                    
                                                    <td>

                                                            <a href="edit_stock.php?stock_id=<?php echo $stock_id;?>" class="btn btn-success">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Update Stock
                                                            </a>
                                                                                                                                                                                               
                                                            <a href="../controller/stock_controller.php?status=delete&stock_id=<?php echo $stock_id;?>" class="btn btn-danger">
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
        $("#stocktable").DataTable();
        });

    </script>
</html>