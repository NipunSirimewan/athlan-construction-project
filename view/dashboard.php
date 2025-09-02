<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';

    $userrow=$_SESSION["user"];
    $moduleObj=new Module();
    $moduleResult=$moduleObj->getAllModules();

    ?>

    <!DOCTYPE html>
    <head>
        <title>dashboard</title>
        
        <?php
            include_once "../includes/bootstrap_css_includes.php";
        ?>

    </head>
    <body>
        <div class="container">
            <?php $pageName="DASHBOARD"?>
            <?php include_once "../includes/header_row_includes.php"; ?>
            <br>

            <?php
                while($module_row=$moduleResult->fetch_assoc()){
                    ?>

                    <div class="col-md-3">
                        <a href="<?php echo $module_row["module_url"] ?>" style="text-decoration:none; color:white;">
                            <div class="panel" style="height:170px; background-color:#008081;">
                                <h1 align="center">
                                    <img src="../images/icons/<?php echo $module_row["module_icon"] ?>" alt="" height="100px" width="100px">
                                </h1>
                                <h4 align="center"><?php echo $module_row["module_name"]; ?></h4>
                            </div>
                        </a>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
    <script src="../js/jquery-3.7.1.js"></script>
</html>