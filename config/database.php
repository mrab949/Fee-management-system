<?php

    class Database {

        private $server = 'localhost';

        private $username = 'root';

        private $password = '';

        private $dbName = 'fees';

        protected $conn;



        //create all table 

        public function __construct() {

            $this->connect();

            $this->createDatabase();

            $this->selectDatabase();

            $this->createStudentTable();

            $this->createAdmintable();

            $this->createFeeProofTable();

            $this->createUpdateMessage();

            $this->challanMsg();

            $this->comment();

        }



        //connect to the database

        private function connect() {

            $this->conn = new mysqli($this->server, $this->username, $this->password);

            

            if ($this->conn->connect_error) {

                die("Connection failed: " . $this->conn->connect_error);

            }

        }



        //create database

        private function createDatabase() {

            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbName";

            

            if (!$this->conn->query($sql)) {

                die("Error while creating database: " . $this->conn->error);

            }

        }



        //select database

        private function selectDatabase() {

            $sql = "USE $this->dbName";

            

            if (!$this->conn->query($sql)) {

                die("Error selecting database: " . $this->conn->error);

            }

        }



        //student table

        private function createStudentTable() {

            $tableName = "students";

            $sql = "CREATE TABLE IF NOT EXISTS $tableName (

                        id INT(11) AUTO_INCREMENT PRIMARY KEY,

                        name VARCHAR(100) NOT NULL,

                        father_name VARCHAR(100) NOT NULL,

                        roll_no VARCHAR(50) NOT NULL,

                        email VARCHAR(100) NOT NULL UNIQUE,

                        session VARCHAR(50) NOT NULL,

                        id_card VARCHAR(255) NOT NULL UNIQUE,

                        dob DATE NOT NULL,

                        gender ENUM('male', 'female', 'other') NOT NULL,

                        fee_status ENUM('unpaid', 'pending', 'paid') DEFAULT 'unpaid',

                        due_date DATE DEFAULT NULL,

                        label VARCHAR(100) DEFAULT '1st Semester',

                        picture VARCHAR(255) NOT NULL DEFAULT 'studentplaceholder.jpg',

                        UNIQUE(roll_no, session)

                    )";

            

            if (!$this->conn->query($sql)) {

                die("Error creating table: " . $this->conn->error);

            }

        }



        //fee proof table

        private function createFeeProofTable() {

            $tableName = "challan";

            $sql = "CREATE TABLE IF NOT EXISTS $tableName (

                        id INT(11) AUTO_INCREMENT PRIMARY KEY,

                        roll_no VARCHAR(50) NOT NULL,

                        session VARCHAR(50) NOT NULL,

                        semester VARCHAR(50) NOT NULL,

                        amount INT(11) NOT NULL,

                        challan VARCHAR(255) DEFAULT '',  

                        fee_status ENUM('unpaid', 'pending', 'paid') DEFAULT 'unpaid',   

                        uploaded_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                        FOREIGN KEY (roll_no, session) REFERENCES students(roll_no, session) ON DELETE CASCADE ON UPDATE CASCADE

                    )";

            

            if (!$this->conn->query($sql)) {

                die("Error creating table: " . $this->conn->error);

            }

        }



        //admin table

        private function createAdmintable(){

            $tableName="admin";

            $sql="CREATE TABLE IF NOT EXISTS $tableName(

                    id INT(11) AUTO_INCREMENT PRIMARY KEY,

                    name VARCHAR(100) NOT NULL,

                    email VARCHAR(100) NOT NULL,

                    password VARCHAR(255) NOT NULL,

                    picture VARCHAR(100) NOT NULL DEFAULT '../uploads/adminplaceholder.jpg'

            )";

            if (!$this->conn->query($sql)) {

                die("Error creating admin table: " . $this->conn->error);

            }

        }



        private function createUpdateMessage(){

            $tableName = "message";

            $sql = "CREATE TABLE IF NOT EXISTS $tableName(

                id INT(11) AUTO_INCREMENT PRIMARY KEY,

                subject VARCHAR(150) NOT NULL,

                message VARCHAR(1000) NOT NULL,

                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )";

            

            if (!$this->conn->query($sql)) {

                die("Error while creating table: " . $this->conn->error);

            }

        }



        private function challanMsg(){

            $tableName = "challanmsg";

            $sql = "CREATE TABLE IF NOT EXISTS $tableName(

                id INT(11) AUTO_INCREMENT PRIMARY KEY,

                roll_no VARCHAR(50) NOT NULL,

                session VARCHAR(50) NOT NULL,

                subject VARCHAR(150) NOT NULL,

                message VARCHAR(1000) NOT NULL,

                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )";

            

            if (!$this->conn->query($sql)) {

                die("Error while creating table: " . $this->conn->error);

            }

        }



        private function comment(){

            $sql="CREATE TABLE IF NOT EXISTS comments (

                id INT AUTO_INCREMENT PRIMARY KEY,

                name VARCHAR(100) NOT NULL,

                email VARCHAR(100) NOT NULL,

                comment TEXT NOT NULL,

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )";



            if (!$this->conn->query($sql)) {

                die("Error while creating table: " . $this->conn->error);

            }

        }

    }

?>
