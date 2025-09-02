<?php
    include_once '../commons/db_connection.php';
    $dbcon=new DbConnection();

    class User{

        public function getAllRoles(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM role";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getRoleModules($roleId){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM role_module r,module m WHERE r.module_id=m.module_id AND r.role_id='$roleId'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getModuleFunctions($moduleId){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM function WHERE module_id='$moduleId'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function addUser($fname,$lname,$email,$nic,$cnumber,$dob,$uname,$cemail,$uimage,$urole){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO user (first_name,last_name,email,nic,contact_number,dob,user_name,company_email,image,role)
            VALUES ('$fname','$lname','$email','$nic','$cnumber','$dob','$uname','$cemail','$uimage','$urole')";
            $con->query($sql) or die($con->error);
            $user_id=$con->insert_id;
            return $user_id;
        }

        public function addUserFunctions($user_id,$fun_id){
            $con=$GLOBALS["con"];
            $sql="INSERT INTO function_user(fun_id,user_id) VALUES ('$fun_id','$user_id')";
            $con->query($sql) or die($con->error);
        }

        public function getAllUsers(){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM user WHERE status !=-1";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function activateuser($user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET status='1' WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deactivateuser($user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET status='0' WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function deleteuser($user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET status='-1' WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getUser($user_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM user u,role r WHERE u.role=r.role_id AND user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getUserFunctions($user_id){
            $con=$GLOBALS["con"];
            $sql="SELECT * FROM function_user WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function updateUser($fname,$lname,$email,$nic,$cnumber,$dob,$uname,$cemail,$uimage,$urole,$user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET first_name='$fname',"
            ."last_name='$lname',"
            ."email='$email',"
            ."nic='$nic',"
            ."contact_number='$cnumber',"
            ."dob='$dob',"
            ."user_name='$uname',"
            ."company_email='$cemail',"
            ."image='$uimage',"
            ."role='$urole'"
            ."WHERE user_id='$user_id'";
            $con->query($sql) or die($con->error);
        }

        public function removeUserFunctions($user_id){
            $con=$GLOBALS["con"];
            $sql="DELETE FROM function_user WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function getActiveUserCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(user_id) as user_count FROM user WHERE status=1;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function getDeActiveUserCount(){
            $con=$GLOBALS["con"];
            $sql="SELECT COUNT(user_id) as user_count FROM user WHERE status=0;";
            $result=$con->query($sql) or die($con->error);
            return $result;
        }

        public function paiduser($user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET payment='1' WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

        public function notpaiduser($user_id){
            $con=$GLOBALS["con"];
            $sql="UPDATE user SET payment='0' WHERE user_id='$user_id'";
            $result=$con->query($sql) or die($con->error);
        }

    }