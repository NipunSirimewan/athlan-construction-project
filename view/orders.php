<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/order_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $orderObj=new Order();
    $successResult=$orderObj->getSuccessCount();
    $success_row=$successResult->fetch_assoc();
    $pendingResult=$orderObj->getPendingCount();
    $pending_row=$pendingResult->fetch_assoc(); 

?>

<html>
    <head>
        <title>order management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
            <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
    </head>

<body>
    <div class="container">
        <?php $pageName="ORDER MANAGEMENT"?>
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
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Success Orders</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $success_row["order_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Pending Orders</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $pending_row["order_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin-left:100px;">
                        <div id="tester" style="height:250px;">
                        </div>
                    </div> 
                </div>

            </div>

        </div>
    </div>
</body>
    <script src="../js/jquery-3.7.1.js"></script>

    <script>
    var data = [{
        values: [<?php echo $success_row["order_count"];?>, <?php echo $pending_row["order_count"]; ?>],
        labels: ['Success Order Count','Pending Order Count'],
        type: 'pie'
    }];

    var layout = {
        height: 400,
        width: 500
    };

    Plotly.newPlot('tester', data, layout);
    </script>

</html>