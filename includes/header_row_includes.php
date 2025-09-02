       <!-- <div>&nbsp;</div> -->
     
       <div align="center">
            <img src="../images/logo.jpg" alt="" width="240px" height="130px">
        </div>
    

    <div class="row" style="background-color:">
        <div class="col-md-6" style="font-size:16px;">
        <span class="glyphicon glyphicon-user"></span>
           <?php 
            echo($userrow["user_name"]); ?>
        </div>

       

        <!-- <div class="col-md-6">
            <h4 align="center"></h4>
        </div> -->

        <div class="col-md-6" align="right">
            <a href="../controller/login_controller.php? status=logout" class="btn btn-primary">Logout</a>
        </div>
    </div>

    <hr>


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4 align="center"><?php echo $pageName;?></h4>
        </div>
    </div>

     <hr>
    