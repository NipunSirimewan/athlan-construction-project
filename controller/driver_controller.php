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

    include '../model/driver_model.php';
    include '../model/login_model.php';
    $driverObj=new Driver();
    $loginObj=new Login();

    switch ($status){
        

            case "add_driver":
                $vtype=$_POST["vtype"];
                $vnumber=$_POST["vnumber"];
                $driver=$_POST["driver"];
                $cnumber=$_POST["cnumber"];
                $pnumber=$_POST["pnumber"];
                $description=$_POST["description"];

                

                try{
                    
                    $driver_id=$driverObj->addDriver($vtype,$vnumber,$driver,$cnumber,$pnumber,$description);

                    
                    if($driver_id>0){
                        

                        $msg="Driver successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_drivers.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_driver.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;

            case "available":
                $driver_id=$_GET["driver_id"];
                $driver_id=base64_decode($driver_id);
                $driverObj->available($driver_id);
                $msg="Successfully Available!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "notavailable":
                $driver_id=$_GET["driver_id"];
                $driver_id=base64_decode($driver_id);
                $driverObj->notavailable($driver_id);
                $msg="Successfully NotAvilable!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "delete":
                $driver_id=$_GET["driver_id"];
                $driver_id=base64_decode($driver_id);
                $driverObj->deletedriver($driver_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_drivers.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_driver":
                $driver_id=$_POST["driver_id"];
                $vtype=$_POST["vtype"];
                $vnumber=$_POST["vnumber"];
                $driver=$_POST["driver"];
                $cnumber=$_POST["cnumber"];
                $description=$_POST["description"];               
                                   
                try{
    

                    $driverResult=$driverObj->getDriver($driver_id);
                    $driverrow=$driverResult->fetch_assoc();

                    //update driver
                    $driverObj->updateDriver($vtype,$vnumber,$driver,$cnumber,$description,$driver_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_driver.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }