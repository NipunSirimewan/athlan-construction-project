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

    include '../model/employee_model.php';
    include '../model/login_model.php';
    $employeeObj=new Employee();
    $loginObj=new Login();

    switch ($status){
        

            case "add_employee":
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];
                $dob=$_POST["dob"];
                $image=$_FILES["image"];
                $employee_role=$_POST["employee_role"];

                

                try{
                    

                    ///uploading image
                    $file_name="";
                    if(isset($_FILES["image"])){
                        if($image["name"] !=""){
                            $file_name=time()."_".$image["name"];
                            $path="../images/employee_images/$file_name";
                            move_uploaded_file($image["tmp_name"],$path);
                        }
                    }
                    $employee_id=$employeeObj->addEmployee($fname,$lname,$email,$nic,$cnumber,$dob,$file_name,$employee_role);

                    
                    if($employee_id>0){
                        

                        $msg="employee $fname $lname successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_employees.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_employee.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;

            case "activate":
                $employee_id=$_GET["employee_id"];
                $employee_id=base64_decode($employee_id);
                $employeeObj->activateemployee($employee_id);
                $msg="Successfully Activated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_employees.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "deactivate":
                $employee_id=$_GET["employee_id"];
                $employee_id=base64_decode($employee_id);
                $employeeObj->deactivateemployee($employee_id);
                $msg="Successfully Deactivated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_employees.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;


            case "paid":
            $employee_id=$_GET["employee_id"];
            $employee_id=base64_decode($employee_id);
            $employeeObj->paidemployee($employee_id);
            $msg="Successfully Updated!!!";
            $msg=base64_encode($msg);

            ?>
            <script>
                window.location="../view/view_employeepayment.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        break;

        case "notpaid":
            $employee_id=$_GET["employee_id"];
            $employee_id=base64_decode($employee_id);
            $employeeObj->notpaidemployee($employee_id);
            $msg="Successfully Updated!!!";
            $msg=base64_encode($msg);

            ?>
            <script>
                window.location="../view/view_employeepayment.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        break;

            case "delete":
                $employee_id=$_GET["employee_id"];
                $employee_id=base64_decode($employee_id);
                $employeeObj->deleteemployee($employee_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_employees.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_employee":
                $employee_id=$_POST["employee_id"];
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];
                $dob=$_POST["dob"];               
                $role=$_POST["employee_role"];

                $image=$_FILES["image"];

              

                

                try{
    

                    $employeeResult=$employeeObj->getEmployee($employee_id);
                    $employeerow=$employeeResult->fetch_assoc();
                    
                    $prev_image=$employeerow["image"];

                    if(isset($_FILES["image"])){
                        if($_FILES["image"] ["name"]!=""){

                            //upload new image
                            $img=time()."_".$_FILES["image"] ["name"];
                            $path="../images/employee_images/";
                            move_uploaded_file($_FILES["image"] ["tmp_name"], $path."$img");

                            //remove previous image
                            if(file_exists($path.$prev_image) && $prev_image!=""){
                                unlink($path.$prev_image);
                            }
                        }
                        else{
                            $img=$prev_image;
                        }
                    }

                    //update employee
                    $employeeObj->updateEmployee($fname,$lname,$email,$nic,$cnumber,$dob,$img,$role,$employee_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_employees.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_employee.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }