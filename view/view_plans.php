<?php
    include_once '../commons/session.php';
    include_once '../model/plan_model.php';

    $userrow=$_SESSION["user"];
    $planObj=new Plan();
    $planResult=$planObj->getAllPlans();

?>

<html>
<head>
    <title>view plans</title>
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
                    <a href="add_plan.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Plan
                    </a>
                    <br>
                    <a href="view_plans.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Plans
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
                                <table class="table table-striped" id="plantable">
                                    <thead>
                                        <tr>
                                            
                                            <th>project Number</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($planrow=$planResult->fetch_assoc()){
                                                $plan_id=$planrow["plan_id"];
                                                $plan_id=base64_encode($plan_id);

                                                
                                    
                                                ?>

                                                <tr>
                                                    

                                                    <td>
                                                        <?php echo $planrow["project_number"]; ?>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                            <a href="view_plan.php?plan_id=<?php echo $plan_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View Plan
                                                            </a>

                                                            <a href="edit_plan.php?plan_id=<?php echo $plan_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>
                                                                                                                                                                                               
                                                            <a href="../controller/plan_controller.php?status=delete&plan_id=<?php echo $plan_id;?>" class="btn btn-danger">
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
        $("#plantable").DataTable();
        });

    </script>
</html>