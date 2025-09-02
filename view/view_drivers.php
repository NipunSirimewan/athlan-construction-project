<?php
    include_once '../commons/session.php';
    include_once '../model/driver_model.php';

    $userrow=$_SESSION["user"];
    $driverObj=new Driver();
    $driverResult=$driverObj->getAllDrivers();

?>

<html>
<head>
    <title>view drivers</title>
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
                                <table class="table table-striped" id="drivertable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Vehicle Type</th>
                                            <th>Contact Number</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($driverrow=$driverResult->fetch_assoc()){
                                                $driver_id=$driverrow["driver_id"];
                                                $driver_id=base64_encode($driver_id);

                                                $status="Available";
                                                if($driverrow["status"]==0){
                                                    $status="Not-Available";
                                                }
                                                ?>

                                                <tr>                                                                                                      
                                                    <td>
                                                        <?php echo $driverrow["vehicle_type"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $driverrow["contact_number"]; ?>
                                                    </td>
                                                   
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($driverrow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($driverrow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>

                                                    <td>
                                                            <a href="view_driver.php?driver_id=<?php echo $driver_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_driver.php?driver_id=<?php echo $driver_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>

                                                            <?php
                                                                if($driverrow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/driver_controller.php?status=available&driver_id=<?php echo $driver_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        available
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/driver_controller.php?status=notavailable&driver_id=<?php echo $driver_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        not-available
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                    
                                                                    <a href="../controller/driver_controller.php?status=delete&driver_id=<?php echo $driver_id;?>" class="btn btn-danger">
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
        $("#drivertable").DataTable();
        });

    </script>
</html>