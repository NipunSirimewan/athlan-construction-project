<?php
    include_once '../commons/session.php';
    include_once '../model/employee_model.php';

    $userrow=$_SESSION["user"];
    $employeeObj=new Employee();
    $employeeResult=$employeeObj->getAllEmployees();

?>

<html>
<head>
    <title>view employees</title>
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
                                <table class="table table-striped" id="employeetable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($employeerow=$employeeResult->fetch_assoc()){
                                                $employee_id=$employeerow["employee_id"];
                                                $employee_id=base64_encode($employee_id);

                                                $img_path="../images/employee_images/";
                                                if($employeerow["image"]==""){
                                                    $img_path=$img_path."employee.png";
                                                }
                                                else{
                                                    $img_path=$img_path.$employeerow["image"];
                                                }
                                                $status="active";
                                                if($employeerow["status"]==0){
                                                    $status="deactive";
                                                }
                                                ?>

                                                <tr>
                                                    <td>
                                                        <img src="<?php echo $img_path ?>" width="80px" height="80px">
                                                    </td>
                                                    <td>
                                                        <?php echo $employeerow["first_name"]." ".$employeerow["last_name"]; ?>
                                                    </td>
                                                   
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($employeerow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($employeerow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>

                                                    <td>
                                                            <a href="view_employee.php?employee_id=<?php echo $employee_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_employee.php?employee_id=<?php echo $employee_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>

                                                            <?php
                                                                if($employeerow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/employee_controller.php?status=activate&employee_id=<?php echo $employee_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        activate
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/employee_controller.php?status=deactivate&employee_id=<?php echo $employee_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        de-activate
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                    
                                                                    <a href="../controller/employee_controller.php?status=delete&employee_id=<?php echo $employee_id;?>" class="btn btn-danger">
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
        $("#employeetable").DataTable();
        });

    </script>
</html>