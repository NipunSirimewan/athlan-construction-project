<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/driver_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $driverObj=new Driver();
    $availableResult=$driverObj->getAvailableDriverCount();
    $available_row=$availableResult->fetch_assoc();
    $notavailableResult=$driverObj->getNotAvailableDriverCount();
    $notavailable_row=$notavailableResult->fetch_assoc(); 

?>

<html>
    <head>
        <title>driver management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
    </head>

<body>
    <div class="container">
        <?php $pageName="DRIVER MANAGEMENT"?>
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
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Available Vehicles</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $available_row["driver_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Not-Available Vehicles</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $notavailable_row["driver_count"];?>
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