<?php
    include_once '../commons/session.php';
    include_once '../model/material_model.php';

    $userrow=$_SESSION["user"];
    $materialObj=new Material();
    $materialResult=$materialObj->getAllMaterials();

?>

<html>
<head>
    <title>view materials</title>
    <?php
        include_once "../includes/bootstrap_css_includes.php";
    ?>

    <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <?php $pageName="" ?>
        <?php include_once "../includes/header_row_includes.php"; ?>

        
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
                <?php
                    if(isset($_GET['msg'])){
                        $msg=base64_decode($_GET['msg']);
                        ?>
                        <div class="row">
                            <div class="alert alert-success">
                                <?php echo $msg ?>
                            </div>
                        </div>
                        <?php
                    }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="materialtable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Material Number</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($materialrow=$materialResult->fetch_assoc()){
                                                $material_id=$materialrow["material_id"];
                                                $material_id=base64_encode($material_id);

                                                $img_path="../images/material_images/";
                                                if($materialrow["image"]==""){
                                                    $img_path=$img_path."empty.png";
                                                }
                                                else{
                                                    $img_path=$img_path.$materialrow["image"];
                                                }
                                    
                                                ?>

                                                <tr>
                                                    <td>
                                                        <img src="<?php echo $img_path ?>" width="70px" height="70px">
                                                    </td>

                                                    <td>
                                                        <?php echo $materialrow["material_number"]; ?>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                            <a href="view_material.php?material_id=<?php echo $material_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_material.php?material_id=<?php echo $material_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>
                                                                                                                                                                                               
                                                            <a href="../controller/material_controller.php?status=delete&material_id=<?php echo $material_id;?>" class="btn btn-danger">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                                Delete 
                                                            </a>
                                                    </td>
                                                
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        
    </div>
    
</body>
    <script src="../js/jquery-3.7.1.js"></script>

    <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function (){
        $("#materialtable").DataTable();
        });

    </script>
</html>