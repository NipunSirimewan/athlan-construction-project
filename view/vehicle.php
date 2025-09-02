<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/vehicle_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $vehicleObj=new Vehicle();
    $doneResult=$vehicleObj->getDoneMaintainCount();
    $done_row=$doneResult->fetch_assoc();
    $notdoneResult=$vehicleObj->getNotdoneMaintainCount();
    $notdone_row=$notdoneResult->fetch_assoc();

?>

<html>
    <head>
        <title>vehicle management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
    </head>

<body>
    <div class="container">
        <?php $pageName="VEHICLE MANAGEMENT"?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_vehicle.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Vehicle
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
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Monthly Maintain Done Vehicles</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $done_row["vehicle_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Monthly Maintain Not-Done Vehicles</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $notdone_row["vehicle_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</body>
    <script src="../js/jquery-3.7.1.js"></script>
</html>