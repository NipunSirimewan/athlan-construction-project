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

    include '../model/customer_model.php';
    include '../model/login_model.php';
    $customerObj=new Customer();
    $loginObj=new Login();

    switch ($status){
        

            case "add_customer":
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];
                
                

                

                try{

                    $customer_id=$customerObj->addCustomer($fname,$lname,$email,$nic,$cnumber);

                    
                    if($customer_id>0){
                        

                        $msg="customer $fname $lname successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_customers.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_customer.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;


            case "delete":
                $customer_id=$_GET["customer_id"];
                $customer_id=base64_decode($customer_id);
                $customerObj->deletecustomer($customer_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_customers.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_customer":
                $customer_id=$_POST["customer_id"];
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $nic=$_POST["nic"];
                $cnumber=$_POST["cnumber"];

            

                try{

                    $customerResult=$customerObj->getCustomer($customer_id);
                    $customerrow=$customerResult->fetch_assoc();
                    

                    //update customer
                    $customerObj->updateCustomer($fname,$lname,$email,$nic,$cnumber,$customer_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_customers.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_customer.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }