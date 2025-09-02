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

    include '../model/vehicle_model.php';
    include '../model/login_model.php';
    $vehicleObj=new Vehicle();
    $loginObj=new Login();

    switch ($status){
        

            case "add_vehicle":
                $vtype=$_POST["vtype"];
                $vnumber=$_POST["vnumber"];
                $description=$_POST["description"];
                $vimage=$_FILES["vimage"];

                try{
                    

                    ///uploading image
                    $file_name="";
                    if(isset($_FILES["vimage"])){
                        if($vimage["name"] !=""){
                            $file_name=time()."_".$vimage["name"];
                            $path="../images/vehicle_images/$file_name";
                            move_uploaded_file($vimage["tmp_name"],$path);
                        }
                    }
                    $vehicle_id=$vehicleObj->addVehicle($vtype,$vnumber,$description,$file_name);

                    
                    if($vehicle_id>0){
                        

                        $msg="Vehicle Number $vnumber successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_vehicles.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_vehicle.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;

            case "done":
                $vehicle_id=$_GET["vehicle_id"];
                $vehicle_id=base64_decode($vehicle_id);
                $vehicleObj->maintaindonevehicle($vehicle_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/vehicles_maintain.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "notdone":
                $vehicle_id=$_GET["vehicle_id"];
                $vehicle_id=base64_decode($vehicle_id);
                $vehicleObj->maintainnotdonevehicle($vehicle_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/vehicles_maintain.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "delete":
                $vehicle_id=$_GET["vehicle_id"];
                $vehicle_id=base64_decode($vehicle_id);
                $vehicleObj->deletevehicle($vehicle_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_vehicles.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_vehicle":
                $vehicle_id=$_POST["vehicle_id"];
                $vtype=$_POST["vtype"];
                $vnumber=$_POST["vnumber"];
                $description=$_POST["description"];

                $vimage=$_FILES["vimage"];

                             
                try{
    

                    $vehicleResult=$vehicleObj->getVehicle($vehicle_id);
                    $vehiclerow=$vehicleResult->fetch_assoc();
                    
                    $prev_image=$vehiclerow["image"];

                    if(isset($_FILES["vimage"])){
                        if($_FILES["vimage"] ["name"]!=""){

                            //upload new image
                            $img=time()."_".$_FILES["vimage"] ["name"];
                            $path="../images/vehicle_images/";
                            move_uploaded_file($_FILES["vimage"] ["tmp_name"], $path."$img");

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
                    $vehicleObj->updateVehicle($vtype,$vnumber,$description,$img,$vehicle_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_vehicles.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_vehicle.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }