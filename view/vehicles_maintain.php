<?php
    include_once '../commons/session.php';
    include_once '../model/vehicle_model.php';

    $userrow=$_SESSION["user"];
    $vehicleObj=new Vehicle();
    $vehicleResult=$vehicleObj->getAllVehicles();

?>

<html>
<head>
    <title>vehicles maintain</title>
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
                                <table class="table table-striped" id="vehicletable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Number</th>
                                            <th>Monthly maintain</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($vehiclerow=$vehicleResult->fetch_assoc()){
                                                $vehicle_id=$vehiclerow["vehicle_id"];
                                                $vehicle_id=base64_encode($vehicle_id);

                                                $img_path="../images/vehicle_images/";
                                                if($vehiclerow["image"]==""){
                                                    $img_path=$img_path."empty.png";
                                                }
                                                else{
                                                    $img_path=$img_path.$vehiclerow["image"];
                                                }
                                                $status="Done";
                                                if($vehiclerow["status"]==0){
                                                    $status="Not-Done";
                                                }
                                                ?>

                                                <tr>
                                                    <td>
                                                        <img src="<?php echo $img_path ?>" width="80px" height="80px">
                                                    </td>

                                                     <td>
                                                        <?php echo $vehiclerow["vehicle_type"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $vehiclerow["vehicle_number"]; ?>
                                                    </td>
                                                   
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($vehiclerow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($vehiclerow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>

                                                    <td>
                                                            
                                                       
                                                            <?php
                                                                if($vehiclerow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/vehicle_controller.php?status=done&vehicle_id=<?php echo $vehicle_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        done
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/vehicle_controller.php?status=notdone&vehicle_id=<?php echo $vehicle_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        not-done
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
        $("#vehicletable").DataTable();
        });

    </script>
</html>