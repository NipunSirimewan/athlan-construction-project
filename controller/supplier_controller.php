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

    include '../model/supplier_model.php';
    include '../model/login_model.php';
    $supplierObj=new Supplier();
    $loginObj=new Login();

    switch ($status){
        

            case "add_supplier":
                $sname=$_POST["sname"];
                $cname=$_POST["cname"];
                $email=$_POST["email"];
                $cnumber=$_POST["cnumber"];
                $description=$_POST["description"];
                
                

                

                try{

                    $supplier_id=$supplierObj->addSupplier($sname,$cname,$email,$cnumber,$description);

                    
                    if($supplier_id>0){
                        

                        $msg="supplier $sname successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_suppliers.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_supplier.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;


            case "delete":
                $supplier_id=$_GET["supplier_id"];
                $supplier_id=base64_decode($supplier_id);
                $supplierObj->deletesupplier($supplier_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_suppliers.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_supplier":
                $supplier_id=$_POST["supplier_id"];
                $sname=$_POST["sname"];
                $cname=$_POST["cname"];
                $email=$_POST["email"];
                $cnumber=$_POST["cnumber"];
                $description=$_POST["description"];

            

                try{

                    $supplierResult=$supplierObj->getSupplier($supplier_id);
                    $supplierrow=$supplierResult->fetch_assoc();
                    

                    //update supplier
                    $supplierObj->updateSupplier($sname,$cname,$email,$cnumber,$description,$supplier_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_suppliers.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_supplier.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }