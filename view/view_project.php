<?php
    include_once "../commons/session.php";
    include_once "../model/project_model.php";

   

    
    $projectObj=new Project();

    $project_id=$_GET["project_id"];
    $project_id=base64_decode($_GET["project_id"]);
    $projectResult=$projectObj->getProject($project_id);
    $projectDetailrow=$projectResult->fetch_assoc();

    $projectresult=$projectObj->getProjectTwo($project_id);
    $projectdetailrow=$projectresult->fetch_assoc();

    

    

    ///to get the information from the session
    $userrow=$_SESSION["user"];

?>

<html>
<head>
    <title>view project</title>
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
                    
                    
                
                   
                    <div class="col-md-7" style="margin-left:100px;">

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Project Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["project_number"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Project Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["project_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Customer Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectDetailrow["first_name"]." ".$projectDetailrow["last_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Project Manager</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["first_name"]." ".$projectdetailrow["last_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Address</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["project_location"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>City</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["city"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Amount</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["amount"];?></h4>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-6">
                                <h4>Start Date</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["start_date"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>End Date</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["end_date"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Description</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $projectdetailrow["description"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>


                    </div>

                        
                        
                        
                    
                
            
        </div>
    </div>

    
</body>

    <script src="../js/jquery-3.7.1.js"></script>

</html>