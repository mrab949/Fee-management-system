<?php

    // require_once('../config/database.php');

    class Admin extends database{



        //add new admin

        public function addAdmin($name,$email,$password){

            $query = "INSERT INTO admin(name,email,password) VALUES (?,?,?)";

            $stmt=$this->conn->prepare($query);

            $stmt->bind_param('sss',$name,$email,$password);

            if ($stmt->execute()) {

                return true;

            }else {

                return false;

            }  

        }

        

        //check admin

        public function adminCheck($email){

            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email = ?");

            $stmt->bind_param('s', $email);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows >0) {

                $stmt->close();

                return true;

            }else{

                $stmt->close();

                return false;

            }

            

        }



        //get admin infomation by selected id 

        public function getAdminByEmail($email) {

            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email = ?");

            if (!$stmt) {

                return false;

            }

        

            $stmt->bind_param('s', $email);

        

            if ($stmt->execute()) {

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    $row = $result->fetch_assoc();

                    $stmt->close();

                    return $row;

                }

            }

            $stmt->close();

            return false;

        }



        //Admin login

        public function adminLogin($name, $password , $remember_me){

            $query = "SELECT * FROM admin WHERE name = ?";

            $stmt=$this->conn->prepare($query);

            $stmt->bind_param('s',$name);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows>0) {

                $row = $result->fetch_assoc();

                if (password_verify($password , $row['password'])) { 

                    session_start();             

                    $_SESSION['id'] = $row['id'];

                    $_SESSION['a_name'] = $row['name'];

                    $_SESSION['a_email'] = $row['email'];

                    $_SESSION['a_picture'] = $row['picture'];

                    if($remember_me){

                        setcookie('a_email', $row['email'], time() + (7*24*60*60), "/");

                    }



                    return true;

                }else {

                    return false;

                }

            }

        }

    

        //Update profile picture 

        public function updateAdminPicture($picture , $id){

            $stmt = $this->conn->prepare("UPDATE admin SET  picture = ? WHERE id = ?");

            $stmt->bind_param('ss',  $picture,$id);



            if ($stmt->execute()) {

                $stmt->close();

                return true; 

            } else {

                $stmt->close();

                return false; 

            }

        }



        //Updaye admin information

        public function updateAdminData($name , $email , $password ,$id){

            $stmt = $this->conn->prepare("UPDATE admin SET  name = ? , email=? , password=? WHERE id = ?");

            $stmt->bind_param('ssss',  $name , $email , $password ,$id);



            if ($stmt->execute()) {

                $stmt->close();

                return true; 

            } else {

                $stmt->close();

                return false; 

            }

        }



        //admin data by email

        public function adminData($email){

            $query = "SELECT name , picture FROM admin WHERE email = ";

            $stmt=$this->conn->prepare($query);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows>0) {

                $row = $result->fetch_assoc();

                return $row;

            }



        }

    }

?>
