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

    include '../model/stock_model.php';
    include '../model/login_model.php';
    $stockObj=new Stock();
    $loginObj=new Login();

    switch ($status){
        

            case "add_stock":
                $type=$_POST["type"];
                $available=$_POST["available"];
                $reorder=$_POST["reorder"];

                try{
                   
                
                    $stock_id=$stockObj->addStock($type,$available,$reorder);

                    
                    if($stock_id>0){
                        

                        $msg="Successfully added!!!";
                        $msg=base64_encode($msg);
                        ?>
                        <script>
                            window.location="../view/view_stocks.php?msg=<?php echo $msg ?>";
                        </script>
                        <?php
                    }
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/add_stock.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }
            break;


            case "delete":
                $stock_id=$_GET["stock_id"];
                $stock_id=base64_decode($stock_id);
                $stockObj->deleteStock($stock_id);
                $msg="Successfully Deleted!!!";
                $msg=base64_encode($msg);

                ?>
                <script>
                    window.location="../view/view_stocks.php?msg=<?php echo $msg;?>";
                </script>
                <?php

            break;

            case "update_stock":
                $stock_id=$_POST["stock_id"];
                $available=$_POST["available"];
                $reorder=$_POST["reorder"];

                             
                try{
    

                    $stockResult=$stockObj->getStock($stock_id);
                    $stockrow=$stockResult->fetch_assoc();

                    //update stock
                    $stockObj->updateStock($available,$reorder,$stock_id);

                    

                    $msg="Successfully Updated!!!";
                    $msg=base64_encode($msg);

                    ?>
                    <script>
                        window.location="../view/view_stocks.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                }

                catch(Exception $ex){
                    $msg=$ex->getMessage();
                    $msg=base64_encode($msg);
                    ?>
                    <script>
                        window.location="../view/edit_stock.php?msg=<?php echo $msg;?>";
                    </script>
                    <?php
                }

            break;
    }