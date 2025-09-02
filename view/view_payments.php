<?php
    include_once '../commons/session.php';
    include_once '../model/payment_model.php';

    $userrow=$_SESSION["user"];
    $paymentObj=new Payment();
    $paymentResult=$paymentObj->getAllPayments();

?>

<html>
<head>
    <title>view project Payments</title>
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
                                <table class="table table-striped" id="paymenttable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Project Amount</th>
                                            <th>Amount Paid</th>
                                            <th>Payment</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($paymentrow=$paymentResult->fetch_assoc()){
                                                $payment_id=$paymentrow["payment_id"];
                                                $payment_id=base64_encode($payment_id);

                                                $status="Done";
                                                if($paymentrow["status"]==0){
                                                    $status="Not-Done";
                                                }
                                                ?>

                                                <tr>                                                                                                      
                                                    <td>
                                                        <?php echo $paymentrow["project_amount"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $paymentrow["amount_paid"]; ?>
                                                    </td>
                                                   
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($paymentrow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($paymentrow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>

                                                    <td>
                                                            <a href="view_payment.php?payment_id=<?php echo $payment_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_payment.php?payment_id=<?php echo $payment_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>

                                                            <?php
                                                                if($paymentrow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/payment_controller.php?status=done&payment_id=<?php echo $payment_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        done
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/payment_controller.php?status=notdone&payment_id=<?php echo $payment_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        not-done
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                    
                                                                    <a href="../controller/payment_controller.php?status=delete&payment_id=<?php echo $payment_id;?>" class="btn btn-danger">
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
        $("#paymenttable").DataTable();
        });

    </script>
</html>