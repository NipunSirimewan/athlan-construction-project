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

    include '../model/payment_model.php';
    include '../model/login_model.php';
    $paymentObj=new Payment();
    $loginObj=new Login();

    switch ($status){
        

            case "add_payment":
                $pro_number=$_POST["pro_number"];
                $amount=$_POST["amount"];
                $paid=$_POST["paid"];
                $date=$_POST["date"];

                try{
                    
                    
                    $payment_id=$paymentObj->addPayment($pro_number,$amount,$paid,$date);

                    
                    if($payment_id>0){
                        

                        $msg="Payment successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_payments.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_payment.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;

            case "done":
                $payment_id=$_GET["payment_id"];
                $payment_id=base64_decode($payment_id);
                $paymentObj->done($payment_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_payments.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "notdone":
                $payment_id=$_GET["payment_id"];
                $payment_id=base64_decode($payment_id);
                $paymentObj->notdone($payment_id);
                $msg="Successfully Updated!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_payments.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            break;

            case "delete":
                $payment_id=$_GET["payment_id"];
                $payment_id=base64_decode($payment_id);
                $paymentObj->deletepayment($payment_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_payments.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_payment":
                $payment_id=$_POST["payment_id"];
                $pro_number=$_POST["pro_number"];
                $amount=$_POST["amount"];
                $paid=$_POST["paid"];
                $date=$_POST["date"];               
                                   
                try{
                    
    

                    $paymentResult=$paymentObj->getPayment($payment_id);
                    $paymentrow=$paymentResult->fetch_assoc();

                    //update payment
                    $paymentObj->updatePayment($pro_number,$amount,$paid,$date,$payment_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_payments.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_payment.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }