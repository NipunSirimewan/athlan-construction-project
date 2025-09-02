<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Customer{

        

        public function addCustomer($fname,$lname,$email,$nic,$cnumber){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO customer (first_name,last_name,email,nic,contact_number)
            VALUES ('$fname','$lname','$email','$nic','$cnumber')";
            $con->query($sql) or die($con->error);
            $customer_id=$con->insert_id;
            return $customer_id;
        }

        public function getAllCustomers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM customer WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function deletecustomer($customer_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE customer SET status='-1' WHERE customer_id='$customer_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getCustomer($customer_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM customer WHERE customer_id='$customer_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function updateCustomer($fname,$lname,$email,$nic,$cnumber,$customer_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE customer SET first_name='$fname',"
            ."last_name='$lname',"
            ."email='$email',"
            ."nic='$nic',"
            ."contact_number='$cnumber'"
            ."WHERE customer_id='$customer_id'";
            $con->query($sql) or die($con->error);
        }

        public function getCustomerCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(customer_id) as customer_count FROM customer WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

    }