<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Plan{

        
        public function addPlan($pnumber,$plan){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO plan (project_number,plan)
            VALUES ('$pnumber','$plan')";
            $con->query($sql) or die($con->error);
            $plan_id=$con->insert_id;
            return $plan_id;
        }

        public function getAllPlans(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM plan WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }


        public function deletePlan($plan_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE plan SET status='-1' WHERE plan_id='$plan_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getPlan($plan_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM plan WHERE plan_id='$plan_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updatePlan($pnumber,$plan,$plan_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE plan SET project_number='$pnumber',"
            ."plan='$plan'"
            ."WHERE plan_id='$plan_id'";
            $con->query($sql) or die($con->error);
        }

        public function getPlanCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(plan_id) as plan_count FROM plan WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }