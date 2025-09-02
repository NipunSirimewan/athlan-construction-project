<?php
    include_once "../commons/session.php";
    include_once "../model/plan_model.php";

   
    $planObj=new Plan();
    $plan_id=$_GET["plan_id"];
    $plan_id=base64_decode($_GET["plan_id"]);
    $planResult=$planObj->getPlan($plan_id);
    $plandetailrow=$planResult->fetch_assoc();

    ///to get the information from the session
    $userrow=$_SESSION["user"];
    

?>

<html>
<head>
    <title>view plan</title>
    <style>
        .container{padding:30px;}
    </style>
</head>
<body>

   <div class="container">
        <?php
            $pdf=$plandetailrow["plan"];               
        ?>
    <embed src="../images/plan_images/<?php echo $pdf;?>" type="application/pdf" width="100%" height="600px">
   </div>
</body>
</html>