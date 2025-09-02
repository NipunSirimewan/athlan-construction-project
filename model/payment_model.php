<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Payment{
        

        public function addPayment($pro_number,$amount,$paid,$date){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO payment (project_number,project_amount,amount_paid,paid_date)
            VALUES ('$pro_number','$amount','$paid','$date')";
            $con->query($sql) or die($con->error);
            $payment_id=$con->insert_id;
            return $payment_id;
        }

        public function getAllPayments(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM payment WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        
        public function done($payment_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE payment SET status='1' WHERE payment_id='$payment_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function notdone($payment_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE payment SET status='0' WHERE payment_id='$payment_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deletepayment($payment_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE payment SET status='-1' WHERE payment_id='$payment_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getPayment($payment_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM payment a,project p WHERE a.project_number=p.project_id AND payment_id='$payment_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updatePayment($pro_number,$amount,$paid,$date,$payment_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE payment SET project_number='$pro_number',"
            ."project_amount='$amount',"
            ."amount_paid='$paid',"
            ."paid_date='$date'"
            ."WHERE payment_id='$payment_id'";
            $con->query($sql) or die($con->error);
        }

        public function getDonePaymentCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(payment_id) as payment_count FROM payment WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getNotDonePaymentCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(payment_id) as payment_count FROM payment WHERE status=0;";
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