<?php
    include_once "../commons/session.php";
    include_once "../model/material_model.php";

    $userrow=$_SESSION["user"];
    $materialObj=new Material();
    


?>

<html>
<head>
    <title>add material</title>
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

            <form action="../controller/material_controller.php?status=add_material" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg"></div>

                        <?php if(isset($_GET["msg"])){
                            ?>
                        <div class="col-md-6 col-md-offset-3 alert alert-danger">
                            <?php echo base64_decode($_GET["msg"]); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                    <div style="margin-left:130px;">

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Material Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="mnumber" id="mnumber" placeholder="M001">
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-3">
                            <label class="control-label">Material Type</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="mtype" id="mtype">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Material Image</label>
                        </div>
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="mimage" id="mimage" onchange="displayImage(this);">
                            <br>
                            <img src="" alt="" id="img_prev">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:125px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
                    </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>

</body>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/materialvalidation.js"></script>

    <script>
        function displayImage(input){
            if(input.files && input.files [0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $("#img_prev").attr('src',e.target.result)
                    .width(80)
                    .height(60);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</html>