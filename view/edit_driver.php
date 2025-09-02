<?php
    include_once "../commons/session.php";
    include_once "../model/driver_model.php";

    $userrow=$_SESSION["user"];
    $driverObj=new Driver();

    $employeeResult=$driverObj->getAllEmployeeDrivers();
    
    

    $driver_id=base64_decode($_GET["driver_id"]);
    $driverResult=$driverObj->getDriver($driver_id);
    $driverrow=$driverResult->fetch_assoc();

?>

<html>
<head>
    <title>edit driver</title>
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
                </ul>
            </div>

            <form action="../controller/driver_controller.php?status=update_driver" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">Vehicle Type</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="hidden" name="driver_id" value="<?php echo $driver_id ?>">
                            <input type="text" class="form-control" name="vtype" id="vtype" value="<?php echo $driverrow["vehicle_type"]; ?>">
                        </div>    
                    </div>

                   <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Vehicle Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="vnumber" id="vnumber" placeholder="CAT0830" value="<?php echo $driverrow["vehicle_number"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Driver</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                        <select name="driver" id="driver" class="form-control" required="required">
                                <option value=""></option>
                                <?php
                                    while($employee_row=$employeeResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $employee_row["employee_id"];?>"
                                        <?php
                                            if($employee_row["employee_id"]==$driverrow["driver"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $employee_row["first_name"]." ".$employee_row["last_name"];?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-3">
                            <label class="control-label">Contact Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="cnumber" id="cnumber" value="<?php echo $driverrow["contact_number"]; ?>">
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
                            <input type="text" class="form-control" name="description" id="description" value="<?php echo $driverrow["description"]; ?>">
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
    <script src="../js/drivervalidation.js"></script>

    

</html>