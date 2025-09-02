<?php
    include_once "../commons/session.php";
    include_once "../model/employee_model.php";

    $userrow=$_SESSION["user"];
    $employeeObj=new Employee();
    $roleResult=$employeeObj->getAllRoles();
    

    $employee_id=base64_decode($_GET["employee_id"]);
    $employeeResult=$employeeObj->getEmployee($employee_id);
    $employeerow=$employeeResult->fetch_assoc();

?>

<html>
<head>
    <title>edit employee</title>
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
                    <a href="add_employee.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Employee
                    </a>
                    <br>
                    <a href="view_employees.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Employees
                    </a>
                    <br>
                    <a href="employee_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Employee Reports
                    </a>
                </ul>
            </div>

            <form action="../controller/employee_controller.php?status=update_employee" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">First Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>">
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $employeerow["first_name"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Last Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $employeerow["last_name"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $employeerow["email"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">NIC</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $employeerow["nic"]; ?>">
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
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cnumber" id="cnumber" value="<?php echo $employeerow["contact_number"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Date of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $employeerow["dob"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                  

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Image</label>
                        </div>
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="image" id="image" onchange="displayImage(this);">
                            <br>
                            
                            <?php
                                if($employeerow["image"]!=""){
                                    $image=$employeerow["image"];
                            ?>
                            <img src="../images/employee_images/<?php echo $image;?>" width="60px" height="80px" id="img_prev">
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
                        <div class="col-md-3">
                            <label class="control-label">Role</label>
                        </div>
                        <div class="col-md-3">
                            <select name="employee_role" id="employee_role" class="form-control" required="required">
                                <option value="">----</option>
                                <?php
                                    while($employee_role_row=$roleResult->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $employee_role_row["role_id"];?>"
                                            <?php
                                                if($employee_role_row["role_id"]==$employeerow["role"]){
                                                    ?>
                                                    selected
                                                    <?php
                                                }
                                                ?>
                                        >
                                                <?php echo $employee_role_row["role_name"];?>
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
    <script src="../js/employeevalidation.js"></script>

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