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

    include '../model/login_model.php';
    $loginObj=new login();

    switch($status){
        case 'login':
        $login_username=$_POST["loginusername"];
        $login_password=$_POST["loginpassword"];

        try{
            if($login_username==""){
                throw new Exception(message: "Username Cannot Be Empty!");
            }
            if($login_password==""){
                throw new Exception(message: "Password Cannot Be Empty!");
            }

            $loginResult=$loginObj->validateuser($login_username,$login_password);

            if($loginResult->num_rows>0){
                $userrow=$loginResult->fetch_assoc();

                $_SESSION["user"]=$userrow;

                ?>
                <script>
                    window.location="../view/dashboard.php";
                </script>
                <?php

            }
            else{
                throw new Exception("invalid credentials");
            }

        }
        catch(Exception $ex){
            echo $msg=$ex->getMessage();
            $msg=base64_encode($msg);
            ?>
            <script>
                window.location="../view/login.php?msg=<?php echo $msg ?>";
            </script>
            <?php
        }
        break;
        case "logout":
            session_destroy();
            ?>
            <script>
                window.location="../view/login.php";
            </script>
            <?php
    }