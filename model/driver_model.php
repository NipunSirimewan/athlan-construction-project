<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Driver{
        

        public function addDriver($vtype,$vnumber,$driver,$cnumber,$pnumber,$description){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO driver (vehicle_type,vehicle_number,driver,contact_number,project_number,description)
            VALUES ('$vtype','$vnumber','$driver','$cnumber','$pnumber','$description')";
            $con->query($sql) or die($con->error);
            $driver_id=$con->insert_id;
            return $driver_id;
        }

        public function getAllDrivers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM driver WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        
        public function available($driver_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE driver SET status='1' WHERE driver_id='$driver_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function notavailable($driver_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE driver SET status='0' WHERE driver_id='$driver_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deletedriver($driver_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE driver SET status='-1' WHERE driver_id='$driver_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getDriver($driver_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM driver d,employee e WHERE d.driver=e.employee_id AND driver_id='$driver_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updateDriver($vtype,$vnumber,$driver,$cnumber,$description,$driver_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE driver SET vehicle_type='$vtype',"
            ."vehicle_number='$vnumber',"
            ."driver='$driver',"
            ."contact_number='$cnumber',"
            ."description='$description'"
            ."WHERE driver_id='$driver_id'";
            $con->query($sql) or die($con->error);
        }

        public function getAvailableDriverCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(driver_id) as driver_count FROM driver WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getNotAvailableDriverCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(driver_id) as driver_count FROM driver WHERE status=0;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getAllEmployeeDrivers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM employee WHERE role=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getAllProjectNumbers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM project";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }


       

        

    }