<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Supplier{

        

        public function addSupplier($sname,$cname,$email,$cnumber,$description){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO supplier (supplier_name,company_name,email,contact_number,description)
            VALUES ('$sname','$cname','$email','$cnumber','$description')";
            $con->query($sql) or die($con->error);
            $supplier_id=$con->insert_id;
            return $supplier_id;
        }

        public function getAllSuppliers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM supplier WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function deletesupplier($supplier_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE supplier SET status='-1' WHERE supplier_id='$supplier_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getSupplier($supplier_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM supplier WHERE supplier_id='$supplier_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function updateSupplier($sname,$cname,$email,$cnumber,$description,$supplier_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE supplier SET supplier_name='$sname',"
            ."company_name='$cname',"
            ."email='$email',"
            ."contact_number='$cnumber',"
            ."description='$description'"
            ."WHERE supplier_id='$supplier_id'";
            $con->query($sql) or die($con->error);
        }

        public function getSupplierCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(supplier_id) as supplier_count FROM supplier WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }