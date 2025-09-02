<?php
    include_once '../commons/session.php';
    include_once '../model/customer_model.php';

    $userrow=$_SESSION["user"];
    $customerObj=new Customer();

    $customerResult=$customerObj->getAllCustomers();

?>

<html>
<head>
    <title>view customers</title>
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
                    <a href="add_customer.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Customer
                    </a>
                    <br>
                    <a href="view_customers.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Customers
                    </a>
                    <br>
                    <a href="customer_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Customer Reports
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
                                <table class="table table-striped" id="customertable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>&nbsp;</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($customerrow=$customerResult->fetch_assoc()){
                                                $customer_id=$customerrow["customer_id"];
                                                $customer_id=base64_encode($customer_id);

                                                
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $customerrow["first_name"]." ".$customerrow["last_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $customerrow["email"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $customerrow["contact_number"]; ?>
                                                    </td>
                                                   
                                                 

                                                    <td>
                                                            <a href="view_customer.php?customer_id=<?php echo $customer_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_customer.php?customer_id=<?php echo $customer_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>
 
                                                            <a href="../controller/customer_controller.php?status=delete&customer_id=<?php echo $customer_id;?>" class="btn btn-danger">
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
        $("#customertable").DataTable();
        });

    </script>

</html>