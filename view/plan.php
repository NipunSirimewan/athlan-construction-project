<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/plan_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $planObj=new Plan();
    $countResult=$planObj->getPlanCount();
    $count_row=$countResult->fetch_assoc();


?>

<html>
    <head>
        <title>project plan management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
    </head>

<body>
    <div class="container">
        <?php $pageName="PROJECT PLAN MANAGEMENT"?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_plan.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Plan
                    </a>
                    <br>
                    <a href="view_plans.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Plans
                    </a>                 
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-10" style="margin-left:70px;">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">No of Plans</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $count_row["plan_count"];?>
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