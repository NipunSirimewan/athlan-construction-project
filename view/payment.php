<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/payment_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $paymentObj=new Payment();
    $doneResult=$paymentObj->getDonePaymentCount();
    $done_row=$doneResult->fetch_assoc();
    $notdoneResult=$paymentObj->getNotDonePaymentCount();
    $notdone_row=$notdoneResult->fetch_assoc(); 

?>

<html>
    <head>
        <title>payment management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
            <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
    </head>

<body>
    <div class="container">
        <?php $pageName="PAYMENT MANAGEMENT"?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_payment.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Project Payment
                    </a>
                    <br>
                    <a href="view_payments.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Project Payments
                    </a>
                    <br>
                    <a href="payment_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Payment Reports
                    </a>
                    <br>
                    <br>
                    <a href="view_userpayment.php" class="list-group-item">
                        <span class="glyphicon glyphicon-minus"></span> &nbsp;
                        View User Payment
                    </a>
                    <br>
                    <a href="view_employeepayment.php" class="list-group-item">
                        <span class="glyphicon glyphicon-minus"></span> &nbsp;
                        View Employee Payment
                    </a>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Done Project Payment</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $done_row["payment_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Not-Done Project Payment</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $notdone_row["payment_count"];?>
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
        values: [<?php echo $done_row["payment_count"];?>, <?php echo $notdone_row["payment_count"]; ?>],
        labels: ['Done Project Payment','Not-Done Project Payment'],
        type: 'pie'
    }];

    var layout = {
        height: 400,
        width: 500
    };

    Plotly.newPlot('tester', data, layout);
    </script>

</html>