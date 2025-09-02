<?php
    include_once "../commons/session.php";
    include_once "../model/driver_model.php";

   

    
    $driverObj=new Driver();

    $driver_id=$_GET["driver_id"];
    $driver_id=base64_decode($_GET["driver_id"]);
    $driverResult=$driverObj->getDriver($driver_id);
    $driverdetailrow=$driverResult->fetch_assoc();

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
                    <a href="add_driver.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Driver
                    </a>
                    <br>
                    <a href="view_drivers.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Drivers
                    </a>
                    <br>
                    <a href="driver_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Driver Reports
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
                                <h4>Vehicle Type</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $driverdetailrow["vehicle_type"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Vehicle Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $driverdetailrow["vehicle_number"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Driver</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $driverdetailrow["first_name"]." ".$driverdetailrow["last_name"];?></h4>
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
                                <h4><?php echo $driverdetailrow["contact_number"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>


                         <div class="row">
                            <div class="col-md-6">
                                <h4>Description</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $driverdetailrow["description"];?></h4>
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