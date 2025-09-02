<?php
    include_once "../commons/session.php";
    include_once "../model/customer_model.php";

   

    
    $customerObj=new Customer();
    $customer_id=$_GET["customer_id"];
    $customer_id=base64_decode($_GET["customer_id"]);
    $customerResult=$customerObj->getCustomer($customer_id);
    $customerdetailrow=$customerResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view customer</title>
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

            
                
                   
                    <div class="col-md-5" style="margin-left:160px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>First Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $customerdetailrow["first_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Last Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $customerdetailrow["last_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Email</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $customerdetailrow["email"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Nic</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $customerdetailrow["nic"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contact Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $customerdetailrow["contact_number"];?></h4>
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