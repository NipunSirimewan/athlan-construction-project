<?php
    include '../commons/session.php';
    if(!isset($_GET["status"])){
        ?>
        <script>
            window.location="../view/login.php";
        </script>
        <?php
    }

    $status=$_GET["status"];

    include '../model/user_model.php';
    include '../model/login_model.php';
    $userObj=new User();
    $loginObj=new Login();

    switch ($status){
        case "load_functions":
            $role_id=$_POST["role"];
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
                        <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"]; ?>" checked/>
                        <?php echo $fun_row["function_name"];
                        ?> <br>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }

        break;

            case "add_user":
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];
                $dob=$_POST["dob"];
                $uname=$_POST["uname"];
                $cemail=$_POST["cemail"];
                $uimage=$_FILES["uimage"];
                $urole=$_POST["user_role"];

                $user_functions=$_POST["fun"];

                try{

                    ///uploading image
                    $file_name="";
                    if(isset($_FILES["uimage"])){
                        if($uimage["name"] !=""){
                            $file_name=time()."_".$uimage["name"];
                            $path="../images/user_images/$file_name";
                            move_uploaded_file($uimage["tmp_name"],$path);
                        }
                    }
                    $user_id=$userObj->addUser($fname,$lname,$email,$nic,$cnumber,$dob,$uname,$cemail,$file_name,$urole);

                    ///creating a login account
                    if($user_id>0){
                        $loginObj->addUserLogin($user_id,$uname,$nic);

                        ///add user contact
                        // $userObj->addUserContact($user_id,$cnumber);

                        ///add user function
                        foreach($user_functions as $fun_id){
                            $userObj->addUserFunctions($user_id,$fun_id);
                        }

                        $msg="user $fname $lname successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_users.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_user.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;

            case "activate":
                $user_id=$_GET["user_id"];
                $user_id=base64_decode($user_id);
                $userObj->activateUser($user_id);
                $msg="Successfully Activated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_users.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "deactivate":
                $user_id=$_GET["user_id"];
                $user_id=base64_decode($user_id);
                $userObj->deactivateUser($user_id);
                $msg="Successfully Deactivated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_users.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "paid":
                $user_id=$_GET["user_id"];
                $user_id=base64_decode($user_id);
                $userObj->paiduser($user_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_userpayment.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "notpaid":
                $user_id=$_GET["user_id"];
                $user_id=base64_decode($user_id);
                $userObj->notpaiduser($user_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_userpayment.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "delete":
                $user_id=$_GET["user_id"];
                $user_id=base64_decode($user_id);
                $userObj->deleteuser($user_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_users.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_user":
                $user_id=$_POST["user_id"];
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];
                $dob=$_POST["dob"];
                $uname=$_POST["uname"];
                $cemail=$_POST["cemail"];
                $urole=$_POST["user_role"];

                $uimage=$_FILES["uimage"];

                if(isset($_POST["fun"])){
                    $user_functions=$_POST["fun"];
                }

                

                try{
                    
                    $userResult=$userObj->getUser($user_id);
                    $userrow=$userResult->fetch_assoc();
                    
                    $prev_image=$userrow["image"];

                    if(isset($_FILES["uimage"])){
                        if($_FILES["uimage"] ["name"]!=""){

                            //upload new image
                            $img=time()."_".$_FILES["uimage"] ["name"];
                            $path="../images/user_images/";
                            move_uploaded_file($_FILES["uimage"] ["tmp_name"], $path."$img");

                            //remove previous image
                            if(file_exists($path.$prev_image) && $prev_image!=""){
                                unlink($path.$prev_image);
                            }
                        }
                        else{
                            $img=$prev_image;
                        }
                    }

                    //update user
                    $userObj->updateUser($fname,$lname,$email,$nic,$cnumber,$dob,$uname,$cemail,$img,$urole,$user_id);

                    //delete existing functions
                    $userObj->removeUserFunctions($user_id);

                    //adding update functions
                    foreach($user_functions as $f){
                        $userObj->addUserFunctions($user_id,$f);
                    }

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_users.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_user.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;

            
        
    }