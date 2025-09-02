<?php
    include_once "../commons/session.php";
    include_once "../model/user_model.php";

    $userrow=$_SESSION["user"];
    $userObj=new User();
    $roleResult=$userObj->getAllRoles();

    $user_id=base64_decode($_GET["user_id"]);
    $userResult=$userObj->getUser($user_id);
    $userrow=$userResult->fetch_assoc();

    ///getting already assigned user functions
    $functionArray=array();
    $userfunctionResult=$userObj->getUserFunctions($user_id);
    while($fun_row=$userfunctionResult->fetch_assoc()){
        array_push($functionArray,$fun_row["fun_id"]);
    }
?>

<html>
<head>
    <title>edit user</title>
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
                </ul>
            </div>

            <form action="../controller/user_controller.php?status=update_user" method="post" enctype="multipart/form-data">
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
                            <label class="control-label">First Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $userrow["first_name"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Last Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $userrow["last_name"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $userrow["email"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">NIC</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $userrow["nic"]; ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Contact Number</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cnumber" id="cnumber" value="<?php echo $userrow["contact_number"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Date of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $userrow["dob"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">User Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="uname" id="uname" value="<?php echo $userrow["user_name"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Company Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="email" class="form-control" name="cemail" id="cemail" value="<?php echo $userrow["company_email"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Image</label>
                        </div>
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="uimage" id="uimage" onchange="displayImage(this);">
                            <br>
                            
                            <?php
                                if($userrow["image"]!=""){
                                    $image=$userrow["image"];
                            ?>
                            <img src="../images/user_images/<?php echo $image;?>" width="60px" height="80px" id="img_prev">
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">User Role</label>
                        </div>
                        <div class="col-md-3">
                            <select name="user_role" id="user_role" class="form-control" required="required">
                                <option value="">----</option>
                                <?php
                                    while($role_row=$roleResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $role_row["role_id"];?>"
                                        <?php
                                            if($role_row["role_id"]==$userrow["role"]){
                                                ?>
                                                selected
                                                <?php
                                            }
                                            ?>
                                >
                                        <?php echo $role_row["role_name"];?>
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
                        <div id="display_functions">
                                <?php
                                    $role_id=$userrow["role"];
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
                                                <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"];?>"
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

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
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
    <script src="../js/uservalidation.js"></script>

    <script>
        function displayImage(input){
            if(input.files && input.files [0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $("#img_prev").attr('src',e.target.result)
                        .width(80)
                        .height(60);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</html>