<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/project_model.php';

    ///to get the information from the session

    $userrow=$_SESSION["user"];

    $projectObj=new Project();
    $completeResult=$projectObj->getCompleteProjectCount();
    $complete_row=$completeResult->fetch_assoc();
    $ongoingResult=$projectObj->getOngoingProjectCount();
    $ongoing_row=$ongoingResult->fetch_assoc(); 

?>

<html>
    <head>
        <title>project management</title>
            <?php
                include_once '../includes/bootstrap_css_includes.php';
            ?>
            <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
    </head>

<body>
    <div class="container">
        <?php $pageName="PROJECT MANAGEMENT"?>
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
                </ul>
            </div>

            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">Ongoing Projects</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $ongoing_row["project_count"];?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <h4 align="center">Complete Projects</h4>
                        </div>
                        <div class="panel-body">
                            <h1 class="h1" align="center">
                                <?php echo $complete_row["project_count"];?>
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
        values: [<?php echo $ongoing_row["project_count"];?>, <?php echo $complete_row["project_count"]; ?>],
        labels: ['Ongoing Project Count','Complete Project Count'],
        type: 'pie'
    }];

    var layout = {
        height: 400,
        width: 500
    };

    Plotly.newPlot('tester', data, layout);
    </script>

</html>