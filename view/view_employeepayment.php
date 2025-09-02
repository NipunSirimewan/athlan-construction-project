<?php
    include_once '../commons/session.php';
    include_once '../model/employee_model.php';

    $userrow=$_SESSION["user"];
    $employeeObj=new Employee();
    $employeeResult=$employeeObj->getAllEmployees();

?>

<html>
<head>
    <title>view employees payment</title>
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
                                <table class="table table-striped" id="employeetable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Name</th>
                                            <th>Monthly Payment</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($employeerow=$employeeResult->fetch_assoc()){
                                                $employee_id=$employeerow["employee_id"];
                                                $employee_id=base64_encode($employee_id);

                                                $payment="Paid";
                                                if($employeerow["payment"]==0){
                                                    $payment="Not-Paid";
                                                }
                                                ?>

                                                <tr>
                                                   
                                                    <td>
                                                        <?php echo $employeerow["first_name"]." ".$employeerow["last_name"]; ?>
                                                    </td>
                                                   
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($employeerow["payment"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($employeerow["payment"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $payment; ?>
                                                    </td>

                                                    <td>
                                                            

                                                            <?php
                                                                if($employeerow["payment"]==0){
                                                                    ?>
                                                                    <a href="../controller/employee_controller.php?status=paid&employee_id=<?php echo $employee_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        paid
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/employee_controller.php?status=notpaid&employee_id=<?php echo $employee_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        not-paid
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                    
                                                                   
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
        $("#employeetable").DataTable();
        });

    </script>
</html>