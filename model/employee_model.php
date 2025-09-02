<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class Employee{

        public function getAllRoles(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM employee_role";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function addEmployee($fname,$lname,$email,$nic,$cnumber,$dob,$image,$employee_role){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO employee (first_name,last_name,email,nic,contact_number,dob,image,role)
            VALUES ('$fname','$lname','$email','$nic','$cnumber','$dob','$image','$employee_role')";
            $con->query($sql) or die($con->error);
            $employee_id=$con->insert_id;
            return $employee_id;
        }

        public function getAllEmployees(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM employee WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        
        public function activateemployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET status='1' WHERE employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deactivateemployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET status='0' WHERE employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deleteemployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET status='-1' WHERE employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getEmployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM employee e,employee_role r WHERE e.role=r.role_id AND employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        

        public function updateEmployee($fname,$lname,$email,$nic,$cnumber,$dob,$image,$role,$employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET first_name='$fname',"
            ."last_name='$lname',"
            ."email='$email',"
            ."nic='$nic',"
            ."contact_number='$cnumber',"
            ."dob='$dob',"
            ."image='$image',"
            ."role='$role'"
            ."WHERE employee_id='$employee_id'";
            $con->query($sql) or die($con->error);
        }

        public function getActiveEmployeeCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(employee_id) as employee_count FROM employee WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getDeActiveEmployeeCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(employee_id) as employee_count FROM employee WHERE status=0;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function paidemployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET payment='1' WHERE employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function notpaidemployee($employee_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE employee SET payment='0' WHERE employee_id='$employee_id'";
            $result=$con->query($sql) or die($con->error);
        }

        

    }