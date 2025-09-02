<?php
    include_once "../commons/session.php";
    include_once "../model/module_model.php";
    include_once "../model/user_model.php";

   
    

    
    $userObj=new User();
    $user_id=$_GET["user_id"];
    $user_id=base64_decode($_GET["user_id"]);
    $userResult=$userObj->getUser($user_id);
    $userdetailrow=$userResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    $moduleObj=new Module();
    $moduleResult=$moduleObj->getAllModules();

    ///getting already assigned user functions
    $functionArray=array();
    $userfunctionResult=$userObj->getUserFunctions($user_id);
    while($fun_row=$userfunctionResult->fetch_assoc()){
        array_push($functionArray,$fun_row["fun_id"]);
    }
    $userResult=$userObj->getAllUsers();
?>

<html>
<head>
    <title>view user</title>
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
                    <a href="add_user.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add User
                    </a>
                    <br>
                    <a href="view_users.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View User
                    </a>
                    <br>
                    <a href="user_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate User Reports
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
                            $img=$userdetailrow["image"];
                            if($img==""){
                                $img="user.png";
                            }
                            ?>
                            <img src="../images/user_images/<?php echo $img;?>" width="300px" height="300px">
                    </div>
                   
                    <div class="col-md-7" style="height:450px">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>First Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $userdetailrow["first_name"];?></h4>
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
                                <h4><?php echo $userdetailrow["last_name"];?></h4>
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
                                <h4><?php echo $userdetailrow["email"];?></h4>
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
                                <h4><?php echo $userdetailrow["nic"];?></h4>
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
                                <h4><?php echo $userdetailrow["contact_number"];?></h4>
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
                                <h4><?php echo $userdetailrow["dob"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>User Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $userdetailrow["user_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Company Email</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $userdetailrow["company_email"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>User Role</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $userdetailrow["role_name"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>


                    </div>

                        <div class="row">
                            <div id="display_functions">
                            
                            <?php
                            $role_id=$userdetailrow["role"];
                            $moduleResult=$userObj->getRoleModules($role_id);

                            while($module_row=$moduleResult->fetch_assoc()){
                                $module_id=$module_row["module_id"];
                                $functionResult=$userObj->getModuleFunctions($module_id);
                                ?>
                                <div class="col-md-4">
                                <h4>
                                <?php
                                    echo $module_row["module_name"];
                                    echo "<br/>";
                                ?>
                                </h4>

                                <?php
                                    while($fun_row=$functionResult->fetch_assoc()){
                                        ?>
                                        <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"];?>" onclick="return false;"
                                            <?php
                                                if(in_array($fun_row["function_id"],$functionArray)){
                                                    ?>
                                                    checked
                                                    <?php
                                                    }
                                                    ?>
                                        />
                                        <?php echo $fun_row["function_name"];
                                        ?> <br>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
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