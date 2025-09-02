<?php
    include_once "../commons/session.php";
    include_once "../model/payment_model.php";

   

    
    $paymentObj=new Payment();

    $payment_id=$_GET["payment_id"];
    $payment_id=base64_decode($_GET["payment_id"]);
    $paymentResult=$paymentObj->getPayment($payment_id);
    $paymentdetailrow=$paymentResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view driver</title>
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
                                <h4>Project Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $paymentdetailrow["project_number"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Project Amount</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $paymentdetailrow["project_amount"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Amount Paid</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $paymentdetailrow["amount_paid"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Paid Date</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $paymentdetailrow["paid_date"];?></h4>
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