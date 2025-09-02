<?php
    include_once '../commons/session.php';
    include_once '../model/project_model.php';

    $userrow=$_SESSION["user"];
    $projectObj=new Project();

    $projectResult=$projectObj->getAllProjects();

?>

<html>
<head>
    <title>view projects</title>
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
                    <a href="add_project.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Project
                    </a>
                    <br>
                    <a href="view_projects.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Projects
                    </a>
                    <br>
                    <a href="project_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Project Reports
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
                                <table class="table table-striped" id="projecttable">
                                    
                                    <thead>
                                        <tr>                                       
                                            
                                            <th>Project Number</th>
                                            <th>Project Name</th>
                                            <th>status</th>
                                            <th>&nbsp;</th>
                                                                                                            
                                        </tr>
                                    </thead>
                                    
                                        <tbody>
                                            <?php
                                            while($projectrow=$projectResult->fetch_assoc()){
                                                $project_id=$projectrow["project_id"];
                                                $project_id=base64_encode($project_id);
                                                

                                                $status="ongoing";
                                                if($projectrow["status"]==0){
                                                    $status="complete";
                                                }
                                                
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $projectrow["project_number"]; ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?php echo $projectrow["project_name"]; ?>
                                                    </td>

                                                    <td
                                                        <?php 
                                                            if($projectrow["status"]==1){
                                                                ?>
                                                                class="warning"
                                                                <?php
                                                            }else if($projectrow["status"]==0){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>
                                                   
                                                 

                                                    <td>
                                                            <a href="view_project.php?project_id=<?php echo $project_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_project.php?project_id=<?php echo $project_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>

                                                            <?php
                                                                if($projectrow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/project_controller.php?status=complete&project_id=<?php echo $project_id;?>" class="btn btn-warning">
                                                                        ongoing
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/project_controller.php?status=ongoing&project_id=<?php echo $project_id;?>" class="btn btn-success">
                                                                        complete
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
 
                                                            <a href="../controller/project_controller.php?status=delete&project_id=<?php echo $project_id;?>" class="btn btn-danger">
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
        $("#projecttable").DataTable();
        });

    </script>

</html>