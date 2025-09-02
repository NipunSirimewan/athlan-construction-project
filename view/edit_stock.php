<?php
    include_once "../commons/session.php";
    include_once "../model/stock_model.php";

    $userrow=$_SESSION["user"];
    $stockObj=new Stock();
    

    $stock_id=base64_decode($_GET["stock_id"]);
    $stockResult=$stockObj->getStock($stock_id);
    $stockrow=$stockResult->fetch_assoc();

?>

<html>
<head>
    <title>update stock</title>
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
                </ul>
            </div>

            <form action="../controller/stock_controller.php?status=update_stock" method="post" enctype="multipart/form-data">
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


                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Available QTY</label>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="stock_id" value="<?php echo $stock_id ?>">
                            <input type="number" class="form-control" name="available" id="available" value="<?php echo $stockrow["available_qty"]; ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Reorder Level</label>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="reorder" id="reorder" value="<?php echo $stockrow["reorder_level"]; ?>">
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                                                        
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:17px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>
    
</body>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/stockvalidation.js"></script>

    

</html>