<?php
    include_once "../commons/session.php";
    include_once "../model/project_model.php";

    $userrow=$_SESSION["user"];
    $projectObj=new Project();
    $customerResult=$projectObj->getAllCustomers();
    $userResult=$projectObj->getAllProjectManagers();


?>

<html>
<head>
    <title>add project</title>
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

            <form action="../controller/project_controller.php?status=add_project" method="post" enctype="multipart/form-data">
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
                    
                    <div style="margin-left:130px;">

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Project Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="pro_number" id="pro_number" placeholder="P00001">
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
                            <input type="text" class="form-control" name="pro_name" id="pro_name">
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
                                <option value="<?php echo $customer_row["customer_id"];?>">
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
                                <option value="<?php echo $user_row["user_id"];?>">
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
                            <input type="text" class="form-control" name="pro_location" id="pro_location">
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
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Amount (Rs)</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="1,000,000.00">
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
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label" style="margin-left:70px;">End Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="end_date" id="end_date">
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
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                    

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:125px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
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