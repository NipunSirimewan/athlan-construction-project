
<html>
<head>

    <title>login</title>
    <?php include_once "../includes/bootstrap_css_includes.php"; ?>
</head>
<body>
    <div class="container">
        <div class="row" style="height:100px"></div>
        <form action="../controller/login_controller.php?status=login" method="post">
        <div class="row">
            <div id="msg" class="col-md-6 col-md-offset-2"></div>
            <?php
                if (isset($_GET["msg"])){
                    ?>
                    <div class="col-md-6 col-md-offset-3 alert alert-danger">
                    <?php
                    echo base64_decode(string:$_GET["msg"]);
                    ?>
                    </div>
                    <?php
                }
                ?>
        </div>

        <div class="row">
                <div class="col-md-8 col-md-offset-2 panel panel-default" style="height:300px">
                    <div class="col-md-6" style="height:200px">
                    <br>
                    <br>
                    <br>
                    <img src="../images/logo.jpg" height="160px">
                    </div>
                    <div class="col-md-6" style="height:300px">
                        <div class="row"></div>
                        <div class="row">
                            <h3>HELLO!!!</h3>
                            <h5>Please Enter Your Information to Login</h5>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                        <input type="text" name="loginusername" id="loginusername" class="form-control" placeholder="User Name">
                                </span>
                            </div>
                        </div>

                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </span>
                                    <input type="password" name="loginpassword" id="loginpassword" class="form-control" placeholder="Password">
                                </span>
                            </div>
                        </div>

                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    
</body>
<script src="../js/jquery-3.7.1.js"></script>
</html>