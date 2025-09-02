<?php
    include_once "../commons/session.php";
    include_once "../model/project_model.php";

    $userrow=$_SESSION["user"];
    $projectObj=new Project();
    $customerResult=$projectObj->getAllCustomers();
    $userResult=$projectObj->getAllProjectManagers();
    

    $project_id=base64_decode($_GET["project_id"]);
    $projectResult=$projectObj->getProject($project_id);
    $projectRow=$projectResult->fetch_assoc();

    $projectresult=$projectObj->getProjectTwo($project_id);
    $projectrow=$projectresult->fetch_assoc();

   

?>

<html>
<head>
    <title>edit project</title>
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
                </ul>
            </div>

            <form action="../controller/project_controller.php?status=update_project" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">Project Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="pro_number" id="pro_number"  placeholder="P00001" value="<?php echo $projectrow["project_number"]; ?>">
                        </div>
                     </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Project Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
                            <input type="text" class="form-control" name="pro_name" id="pro_name" value="<?php echo $projectrow["project_name"]; ?>">
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Customer Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <select name="cus_name" id="cus_name" class="form-control" required="required">
                                <option value=""></option>
                                <?php
                                    while($customer_row=$customerResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $customer_row["customer_id"];?>"
                                        <?php
                                            if($customer_row["customer_id"]==$projectRow["customer_name"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $customer_row["first_name"]." ".$customer_row["last_name"];?>
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
                        <div class="col-md-3">
                            <label class="control-label">Project Manager</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <select name="pro_manager" id="pro_manager" class="form-control" required="required">
                                <option value=""></option>
                                <?php
                                    while($user_row=$userResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $user_row["user_id"];?>"
                                        <?php
                                            if($user_row["user_id"]==$projectrow["project_manager"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $user_row["first_name"]." ".$user_row["last_name"];?>
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
                    <div class="col-md-3">
                            <label class="control-label">Address</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="pro_location" id="pro_location" value="<?php echo $projectrow["project_location"]; ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-3">
                            <label class="control-label">City</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $projectrow["city"]; ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Amount</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $projectrow["amount"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Start Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo $projectrow["start_date"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">End Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo $projectrow["end_date"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Description</label>
                        </div>
                        <div class="col-md-3" style="width:540px;">
                            <input type="text" class="form-control" name="description" id="description" value="<?php echo $projectrow["description"]; ?>">
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
    <script src="../js/projectvalidation.js"></script>

    

</html>