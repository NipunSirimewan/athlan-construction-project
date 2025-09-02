<?php
    include_once '../commons/session.php';
    include_once '../model/module_model.php';
    include_once '../model/user_model.php';

    $userrow=$_SESSION["user"];
    $moduleObj=new Module();
    $userObj=new User();

    $moduleResult=$moduleObj->getAllModules();
    $userResult=$userObj->getAllUsers();

?>

<html>
<head>
    <title>view users</title>
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
                    <a href="add_user.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add User
                    </a>
                    <br>
                    <a href="view_users.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Users
                    </a>
                    <br>
                    <a href="user_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate User Reports
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
                                <table class="table table-striped" id="usertable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            while($userrow=$userResult->fetch_assoc()){
                                                $user_id=$userrow["user_id"];
                                                $user_id=base64_encode($user_id);

                                                $img_path="../images/user_images/";
                                                if($userrow["image"]==""){
                                                    $img_path=$img_path."user.png";
                                                }
                                                else{
                                                    $img_path=$img_path.$userrow["image"];
                                                }
                                                $status="active";
                                                if($userrow["status"]==0){
                                                    $status="deactive";
                                                }
                                                ?>

                                                <tr>
                                                    <td>
                                                        <img src="<?php echo $img_path ?>" width="80px" height="80px">
                                                    </td>
                                                    <td>
                                                        <?php echo $userrow["user_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $userrow["first_name"]." ".$userrow["last_name"]; ?>
                                                    </td>
                                                   
                                                    
                                                    <td
                                                        <?php 
                                                            if($userrow["status"]==1){
                                                                ?>
                                                                class="success"
                                                                <?php
                                                            }else if($userrow["status"]==0){
                                                                ?>
                                                                class="danger"
                                                                <?php
                                                            }
                                                        ?>
                                                            >
                                                        <?php echo $status; ?>
                                                    </td>

                                                    <td>
                                                            <a href="view_user.php?user_id=<?php echo $user_id;?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                                View
                                                            </a>

                                                            <a href="edit_user.php?user_id=<?php echo $user_id;?>" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                Edit
                                                            </a>

                                                            <?php
                                                                if($userrow["status"]==0){
                                                                    ?>
                                                                    <a href="../controller/user_controller.php?status=activate&user_id=<?php echo $user_id;?>" class="btn btn-success">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        activate
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="../controller/user_controller.php?status=deactivate&user_id=<?php echo $user_id;?>" class="btn btn-danger">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        de-activate
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                    
                                                                    <a href="../controller/user_controller.php?status=delete&user_id=<?php echo $user_id;?>" class="btn btn-danger">
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
        $("#usertable").DataTable();
        });

    </script>

</html>