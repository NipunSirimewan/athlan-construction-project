<?php
    include_once "../commons/session.php";
    include_once "../model/material_model.php";

   
    $materialObj=new Material();
    $material_id=$_GET["material_id"];
    $material_id=base64_decode($_GET["material_id"]);
    $materialResult=$materialObj->getMaterial($material_id);
    $materialdetailrow=$materialResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view material</title>
    <?php
        include_once "../includes/bootstrap_css_includes.php";
    ?>
</head>
<body>

    <div class="container">
        <?php $pageName=""?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_material.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Material
                    </a>
                    <br>
                    <a href="view_materials.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Materials
                    </a>
                    <br>
                    <a href="material_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Material Reports
                    </a>
                    <br>
                    <br>
                    <br>
                    <a href="dashboard.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home"></span> &nbsp;
                       Dashboard 
                    </a>
                </ul>
            </div>

            
                <div class="col-md-9">
                    <div class="col-md-5" style="height:450px">
                        <?php
                            $img=$materialdetailrow["image"];
                            if($img==""){
                                $img="empty.png";
                            }
                            ?>
                            <img src="../images/material_images/<?php echo $img;?>" width="180px" height="180px">
                    </div>
                   
                    <div class="col-md-7" style="height:450px">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Material Number</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $materialdetailrow["material_number"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Material Type</h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $materialdetailrow["material_type"];?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                    </div>               
            
        </div>
    </div>

    
</body>

    <script src="../js/jquery-3.7.1.js"></script>

</html>