<?php
    include_once "../commons/session.php";
    include_once "../model/material_model.php";

    $userrow=$_SESSION["user"];
    $materialObj=new Material();
    

    $material_id=base64_decode($_GET["material_id"]);
    $materialResult=$materialObj->getMaterial($material_id);
    $materialrow=$materialResult->fetch_assoc();

?>

<html>
<head>
    <title>edit material</title>
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
                </ul>
            </div>

            <form action="../controller/material_controller.php?status=update_material" method="post" enctype="multipart/form-data">
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

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Material Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="hidden" name="material_id" value="<?php echo $material_id ?>">
                            <input type="text" class="form-control" name="mnumber" id="mnumber" value="<?php echo $materialrow["material_number"]; ?>">
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
                            <input type="text" class="form-control" name="mtype" id="mtype" value="<?php echo $materialrow["material_type"]; ?>">
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
                            
                            <?php
                                if($materialrow["image"]!=""){
                                    $image=$materialrow["image"];
                            ?>
                            <img src="../images/material_images/<?php echo $image;?>" width="60px" height="80px" id="img_prev">
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                                                        
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:17px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
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