<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/employee_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $employeeObj=new Employee();
    $activeResult=$employeeObj->getActiveEmployeeCount();
    $active_row=$activeResult->fetch_assoc();
    $deactiveResult=$employeeObj->getDeActiveEmployeeCount();
    $deactive_row=$deactiveResult->fetch_assoc(); 

?>

<html>
    <head>
        <title>employee management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
            <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
    </head>

<body>
    <div class="container">
        <?php $pageName="EMPLOYEE MANAGEMENT"?>
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

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Active Employees</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $active_row["employee_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Deactive Employees</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $deactive_row["employee_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin-left:100px;">
                        <div id="tester" style="height:250px;">
                        </div>
                    </div> 
                </div>

            </div>

        </div>
    </div>
</body>
    <script src="../js/jquery-3.7.1.js"></script>

    <script>
    var data = [{
        values: [<?php echo $active_row["employee_count"];?>, <?php echo $deactive_row["employee_count"]; ?>],
        labels: ['Active Employee Count','Deactive Employee Count'],
        type: 'pie'
    }];

    var layout = {
        height: 400,
        width: 500
    };

    Plotly.newPlot('tester', data, layout);
    </script>
</html>