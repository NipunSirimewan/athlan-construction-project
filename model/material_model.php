<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Material{

        
        public function addMaterial($mnumber,$mtype,$mimage){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO material (material_number,material_type,image)
            VALUES ('$mnumber','$mtype','$mimage')";
            $con->query($sql) or die($con->error);
            $material_id=$con->insert_id;
            return $material_id;
        }

        public function getAllMaterials(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM material WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }


        public function deleteMaterial($material_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE material SET status='-1' WHERE material_id='$material_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getMaterial($material_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM material WHERE material_id='$material_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updateMaterial($mnumber,$mtype,$mimage,$material_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE material SET material_number='$mnumber',"
            ."material_type='$mtype',"
            ."image='$mimage'"
            ."WHERE material_id='$material_id'";
            $con->query($sql) or die($con->error);
        }

        public function getMaterialCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(material_id) as material_count FROM material WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }