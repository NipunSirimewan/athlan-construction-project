<?php
    include_once "../commons/session.php";
    include_once "../model/employee_model.php";

   

    
    $employeeObj=new Employee();
    $employee_id=$_GET["employee_id"];
    $employee_id=base64_decode($_GET["employee_id"]);
    $employeeResult=$employeeObj->getEmployee($employee_id);
    $employeedetailrow=$employeeResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view employee</title>
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

            
                <div class="col-md-9">
                    <div class="col-md-5" style="height:450px">
                        <?php
                            $img=$employeedetailrow["image"];
                            if($img==""){
                                $img="employee.png";
                            }
                            ?>
                            <img src="../images/employee_images/<?php echo $img;?>" width="250px" height="250px">
                    </div>
                   
                    <div class="col-md-7" style="height:450px">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>First Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["first_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Last Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["last_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Email</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["email"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Nic</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["nic"];?></h4>
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
                                <h4><?php echo $employeedetailrow["contact_number"];?></h4>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Date of Birth</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["dob"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        

                        

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Role</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $employeedetailrow["role_name"];?></h4>
                            </div>
                        </div>


                    </div>

                        
                        
                        
                    
                
            
        </div>
    </div>

    
</body>

    <script src="../js/jquery-3.7.1.js"></script>

</html>