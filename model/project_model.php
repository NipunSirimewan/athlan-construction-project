<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Project{

        

        public function addProject($pro_number,$pro_name,$cus_name,$pro_manager,$pro_location,$city,$amount,$start_date,$end_date,$description){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO project (project_number,project_name,customer_name,project_manager,project_location,city,amount,start_date,end_date,description)
            VALUES ('$pro_number','$pro_name','$cus_name','$pro_manager','$pro_location','$city','$amount','$start_date','$end_date','$description')";
            $con->query($sql) or die($con->error);
            $project_id=$con->insert_id;
            return $project_id;
        }

        public function getAllProjects(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM project WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function deleteproject($project_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE project SET status='-1' WHERE project_id='$project_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getProject($project_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM project p,customer c WHERE p.customer_name=c.customer_id AND project_id='$project_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getProjectTwo($project_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM project p,user u WHERE p.project_manager=u.user_id AND project_id='$project_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

       

        public function updateProject($pro_number,$pro_name,$cus_name,$pro_manager,$pro_location,$city,$amount,$start_date,$end_date,$description,$project_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE project SET project_number='$pro_number',"
            ."project_name='$pro_name',"
            ."customer_name='$cus_name',"
            ."project_manager='$pro_manager',"
            ."project_location='$pro_location',"
            ."city='$city',"
            ."amount='$amount',"
            ."start_date='$start_date',"
            ."end_date='$end_date',"
            ."description='$description'"
            ."WHERE project_id='$project_id'";
            $con->query($sql) or die($con->error);
        }

        public function getCustomerCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(customer_id) as customer_count FROM customer WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function ongoingproject($project_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE project SET status='0' WHERE project_id='$project_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function completeproject($project_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE project SET status='1' WHERE project_id='$project_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getOngoingProjectCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(project_id) as project_count FROM project WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getCompleteProjectCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(project_id) as project_count FROM project WHERE status=0;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getAllCustomers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM customer";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getAllProjectManagers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM user WHERE role=2;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }