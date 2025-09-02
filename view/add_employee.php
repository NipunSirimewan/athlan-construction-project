<?php
    include_once "../commons/session.php";
    include_once "../model/employee_model.php";

    $userrow=$_SESSION["user"];
    $employeeObj=new Employee();
    $roleResult=$employeeObj->getAllRoles();
    


?>

<html>
<head>
    <title>add employee</title>
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
                    <br>
                    <br>
                    <br>
                    <a href="dashboard.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home"></span> &nbsp;
                       Dashboard 
                    </a>
                </ul>
            </div>

            <form action="../controller/employee_controller.php?status=add_employee" method="post" enctype="multipart/form-data">
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
                            <label class="control-label" style="margin-left:70px;">First Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="fname" id="fname">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Last Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="lname" id="lname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">NIC</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nic" id="nic">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Contact Number</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cnumber" id="cnumber">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Date of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" id="dob">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Image</label>
                        </div>
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="image" id="image" onchange="displayImage(this);">
                            <br>
                            <img src="" alt="" id="img_prev">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                        
                    

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">Role</label>
                        </div>
                        <div class="col-md-3">
                            <select name="employee_role" id="employee_role" class="form-control" required="required">
                                <option value="">----</option>
                                <?php 
                                    while($employee_role_row=$roleResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $employee_role_row["role_id"];?>">
                                        <?php echo $employee_role_row["role_name"];?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:150px;"/>
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