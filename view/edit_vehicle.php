<?php
    include_once "../commons/session.php";
    include_once "../model/vehicle_model.php";

    $userrow=$_SESSION["user"];
    $vehicleObj=new Vehicle();
    

    $vehicle_id=base64_decode($_GET["vehicle_id"]);
    $vehicleResult=$vehicleObj->getVehicle($vehicle_id);
    $vehiclerow=$vehicleResult->fetch_assoc();

?>

<html>
<head>
    <title>edit vehicle</title>
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

            <form action="../controller/vehicle_controller.php?status=update_vehicle" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg"></div>

                        <?php if(isset($_GET["msg"])){
                            ?>
                        <div class="col-md-6 col-md-offset-3 alert alert-danger">
                            <?php echo base64_decode($_GET["msg"]); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Vehicle type</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id ?>">
                            <input type="text" class="form-control" name="vtype" id="vtype" value="<?php echo $vehiclerow["vehicle_type"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Vehicle Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="vnumber" id="vnumber" placeholder="CAT0830" value="<?php echo $vehiclerow["vehicle_number"]; ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    
                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Description</label>
                        </div>
                        <div class="col-md-3" style="width:540px;">
                            <input type="text" class="form-control" name="description" id="description" value="<?php echo $vehiclerow["description"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                  

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Vehicle Image</label>
                        </div>
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="vimage" id="vimage" onchange="displayImage(this);">
                            <br>
                            
                            <?php
                                if($vehiclerow["image"]!=""){
                                    $image=$vehiclerow["image"];
                            ?>
                            <img src="../images/vehicle_images/<?php echo $image;?>" width="60px" height="80px" id="img_prev">
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                                                        
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:17px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>
    
</body>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/vehiclevalidation.js"></script>

    <script>
        function displayImage(input){
            if(input.files && input.files [0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $("#img_prev").attr('src',e.target.result)
                        .width(80)
                        .height(60);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</html>