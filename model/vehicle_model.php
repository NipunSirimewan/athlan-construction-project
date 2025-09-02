<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Vehicle{

        
        public function addVehicle($vtype,$vnumber,$description,$vimage){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO vehicle (vehicle_type,vehicle_number,description,image)
            VALUES ('$vtype','$vnumber','$description','$vimage')";
            $con->query($sql) or die($con->error);
            $vehicle_id=$con->insert_id;
            return $vehicle_id;
        }

        public function getAllVehicles(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM vehicle WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        
        public function maintaindonevehicle($vehicle_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE vehicle SET status='1' WHERE vehicle_id='$vehicle_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function maintainnotdonevehicle($vehicle_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE vehicle SET status='0' WHERE vehicle_id='$vehicle_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deletevehicle($vehicle_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE vehicle SET status='-1' WHERE vehicle_id='$vehicle_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getVehicle($vehicle_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM vehicle WHERE vehicle_id='$vehicle_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updateVehicle($vtype,$vnumber,$description,$vimage,$vehicle_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE vehicle SET vehicle_type='$vtype',"
            ."vehicle_number='$vnumber',"
            ."description='$description',"
            ."image='$vimage'"
            ."WHERE vehicle_id='$vehicle_id'";
            $con->query($sql) or die($con->error);
        }

        public function getDoneMaintainCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(vehicle_id) as vehicle_count FROM vehicle WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getNotdoneMaintainCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(vehicle_id) as vehicle_count FROM vehicle WHERE status=0;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }