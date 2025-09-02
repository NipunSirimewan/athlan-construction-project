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

    include '../model/project_model.php';
    include '../model/login_model.php';
    $projectObj=new Project();
    $loginObj=new Login();

    switch ($status){
        

            case "add_project":
                $pro_number=$_POST["pro_number"];
                $pro_name=$_POST["pro_name"];
                $cus_name=$_POST["cus_name"];
                $pro_manager=$_POST["pro_manager"];
                $pro_location=$_POST["pro_location"];
                $city=$_POST["city"];
                $amount=$_POST["amount"];
                $start_date=$_POST["start_date"];
                $end_date=$_POST["end_date"];
                $description=$_POST["description"];
                
                

                

                try{
                    
                    $project_id=$projectObj->addProject($pro_number,$pro_name,$cus_name,$pro_manager,$pro_location,$city,$amount,$start_date,$end_date,$description);

                    
                    if($project_id>0){
                        

                        $msg="project successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_projects.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_project.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;



            case "ongoing":
                $project_id=$_GET["project_id"];
                $project_id=base64_decode($project_id);
                $projectObj->ongoingproject($project_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_projects.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "complete":
                $project_id=$_GET["project_id"];
                $project_id=base64_decode($project_id);
                $projectObj->completeproject($project_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_projects.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;




            case "delete":
                $project_id=$_GET["project_id"];
                $project_id=base64_decode($project_id);
                $projectObj->deleteproject($project_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_projects.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_project":
                $project_id=$_POST["project_id"];
                $pro_number=$_POST["pro_number"];
                $pro_name=$_POST["pro_name"];
                $cus_name=$_POST["cus_name"];
                $pro_manager=$_POST["pro_manager"];
                $pro_location=$_POST["pro_location"];
                $city=$_POST["city"];
                $amount=$_POST["amount"];
                $start_date=$_POST["start_date"];
                $end_date=$_POST["end_date"];
                $description=$_POST["description"];

            

                try{
                   

                    $projectResult=$projectObj->getProject($project_id);
                    $projectrow=$projectResult->fetch_assoc();
                    

                    //update customer
                    $projectObj->updateProject($pro_number,$pro_name,$cus_name,$pro_manager,$pro_location,$city,$amount,$start_date,$end_date,$description,$project_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_projects.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_project.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }