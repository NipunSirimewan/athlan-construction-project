<?php
    include_once "../commons/session.php";
    include_once "../model/payment_model.php";

    $userrow=$_SESSION["user"];
    $paymentObj=new Payment();
    $projectResult=$paymentObj->getAllProjectNumbers();
    

    $payment_id=base64_decode($_GET["payment_id"]);
    $paymentResult=$paymentObj->getPayment($payment_id);
    $paymentrow=$paymentResult->fetch_assoc();

?>

<html>
<head>
    <title>edit payment</title>
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
                </ul>
            </div>

            <form action="../controller/payment_controller.php?status=update_payment" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">Project Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="hidden" name="payment_id" value="<?php echo $payment_id ?>">
                            <select name="pro_number" id="pro_number" class="form-control" required="required">
                                <option value="">----</option>
                                <?php
                                    while($project_row=$projectResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $project_row["project_id"];?>"
                                        <?php
                                            if($project_row["project_id"]==$paymentrow["project_number"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $project_row["project_number"];?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>    
                    </div>

                   <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Project Amount (Rs)</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="1,000,000.00" value="<?php echo $paymentrow["project_amount"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Amount Paid (Rs)</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="paid" id="paid" placeholder="1,000,000.00" value="<?php echo $paymentrow["amount_paid"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-3">
                            <label class="control-label">Paid Date</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="date" class="form-control" name="date" id="date" value="<?php echo $paymentrow["paid_date"]; ?>">
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
    <script src="../js/paymentvalidation.js"></script>

    

</html>