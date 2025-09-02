<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Stock{

        
        public function addStock($type,$available,$reorder){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO stock (material_type,available_qty,reorder_level)
            VALUES ('$type','$available','$reorder')";
            $con->query($sql) or die($con->error);
            $stock_id=$con->insert_id;
            return $stock_id;
        }

        public function getAllStocks(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM stock WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }


        public function deleteStock($stock_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE stock SET status='-1' WHERE stock_id='$stock_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getStock($stock_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM stock WHERE stock_id='$stock_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updateStock($available,$reorder,$stock_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE stock SET available_qty='$available',"
            ."reorder_level='$reorder'"
            ."WHERE stock_id='$stock_id'";
            $con->query($sql) or die($con->error);
        }

        public function getMaterialCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(stock_id) as stock_count FROM stock WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }