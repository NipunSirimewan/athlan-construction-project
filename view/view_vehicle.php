<?php
    include_once "../commons/session.php";
    include_once "../model/vehicle_model.php";

   
    $vehicleObj=new Vehicle();
    $vehicle_id=$_GET["vehicle_id"];
    $vehicle_id=base64_decode($_GET["vehicle_id"]);
    $vehicleResult=$vehicleObj->getVehicle($vehicle_id);
    $vehicledetailrow=$vehicleResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view vehicle</title>
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
                    <a href="add_vehicle.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Vehcile
                    </a>
                    <br>
                    <a href="view_vehicles.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Vehicles
                    </a>
                    <br>
                    <a href="vehicles_maintain.php" class="list-group-item">
                        <span class="glyphicon glyphicon-minus"></span> &nbsp;
                        Vehicles Maintain
                    </a>
                    <br>
                    <a href="vehicle_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Vehicle Reports
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
                    <div class="col-md-5" style="height:450px">
                        <?php
                            $img=$vehicledetailrow["image"];
                            if($img==""){
                                $img="empty.png";
                            }
                            ?>
                            <img src="../images/vehicle_images/<?php echo $img;?>" width="250px" height="250px">
                    </div>
                   
                    <div class="col-md-7" style="height:450px">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Vehicle Type</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $vehicledetailrow["vehicle_type"];?></h4>
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
                                <h4><?php echo $vehicledetailrow["vehicle_number"];?></h4>
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
                                <h4><?php echo $vehicledetailrow["description"];?></h4>
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