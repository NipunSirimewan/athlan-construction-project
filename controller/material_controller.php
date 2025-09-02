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

    include '../model/material_model.php';
    include '../model/login_model.php';
    $materialObj=new Material();
    $loginObj=new Login();

    switch ($status){
        

            case "add_material":
                $mnumber=$_POST["mnumber"];
                $mtype=$_POST["mtype"];
                $mimage=$_FILES["mimage"];

                try{
                    

                    ///uploading image
                    $file_name="";
                    if(isset($_FILES["mimage"])){
                        if($mimage["name"] !=""){
                            $file_name=time()."_".$mimage["name"];
                            $path="../images/material_images/$file_name";
                            move_uploaded_file($mimage["tmp_name"],$path);
                        }
                    }
                    $material_id=$materialObj->addMaterial($mnumber,$mtype,$file_name);

                    
                    if($material_id>0){
                        

                        $msg="Material Number $mnumber successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_materials.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_material.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;


            case "delete":
                $material_id=$_GET["material_id"];
                $material_id=base64_decode($material_id);
                $materialObj->deleteMaterial($material_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_materials.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_material":
                $material_id=$_POST["material_id"];
                $mnumber=$_POST["mnumber"];
                $mtype=$_POST["mtype"];
                $mimage=$_FILES["mimage"];

                             
                try{
    

                    $materialResult=$materialObj->getMaterial($material_id);
                    $materialrow=$materialResult->fetch_assoc();
                    
                    $prev_image=$materialrow["image"];

                    if(isset($_FILES["mimage"])){
                        if($_FILES["mimage"] ["name"]!=""){

                            //upload new image
                            $img=time()."_".$_FILES["mimage"] ["name"];
                            $path="../images/material_images/";
                            move_uploaded_file($_FILES["mimage"] ["tmp_name"], $path."$img");

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
                    $materialObj->updateMaterial($mnumber,$mtype,$img,$material_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_materials.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_material.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }