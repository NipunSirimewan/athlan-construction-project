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

    include '../model/plan_model.php';
    include '../model/login_model.php';
    $planObj=new Plan();
    $loginObj=new Login();

    switch ($status){
        

            case "add_plan":
                $pnumber=$_POST["pnumber"];
                $plan=$_FILES["plan"];

                try{
                    

                    ///uploading plan
                    $file_name="";
                    if(isset($_FILES["plan"])){
                        if($plan["name"] !=""){
                            $file_name=time()."_".$plan["name"];
                            $path="../images/plan_images/$file_name";
                            move_uploaded_file($plan["tmp_name"],$path);
                        }
                    }
                    $plan_id=$planObj->addPlan($pnumber,$file_name);

                    
                    if($plan_id>0){
                        

                        $msg="Successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_plans.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_plan.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;


            case "delete":
                $plan_id=$_GET["plan_id"];
                $plan_id=base64_decode($plan_id);
                $planObj->deletePlan($plan_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_plans.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_plan":
                $plan_id=$_POST["plan_id"];
                $pnumber=$_POST["pnumber"];
                $plan=$_FILES["plan"];

                             
                try{
    

                    $planResult=$planObj->getPlan($plan_id);
                    $planrow=$planResult->fetch_assoc();
                    
                    $prev_pdf=$planrow["plan"];

                    if(isset($_FILES["plan"])){
                        if($_FILES["plan"] ["name"]!=""){

                            //upload new image
                            $pdf=time()."_".$_FILES["plan"] ["name"];
                            $path="../images/plan_images/";
                            move_uploaded_file($_FILES["plan"] ["tmp_name"], $path."$pdf");

                            //remove previous image
                            if(file_exists($path.$prev_pdf) && $prev_pdf!=""){
                                unlink($path.$prev_pdf);
                            }
                        }
                        else{
                            $pdf=$prev_pdf;
                        }
                    }

                    //update plan
                    $planObj->updatePlan($pnumber,$pdf,$plan_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_plans.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_plan.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }