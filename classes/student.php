<?php
    // require_once ('../config/database.php');

    class Student extends database{
        //check email duplication
        public function isDuplicateEmail($email) {
            $query = "SELECT * FROM students WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->num_rows > 0;
        }

        //check cnic duplication
        public function isDuplicateIdCard($id_card) {
            $query = "SELECT * FROM students WHERE id_card = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $id_card);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->num_rows > 0;
        }

        //check roll no duplication
        public function isDuplicateRollNo($roll_no, $session) {
            $query = "SELECT * FROM students WHERE roll_no = ? AND session = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $roll_no, $session);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->num_rows > 0;
        }

        //insert student data
        public function insertStudentData($name, $father_name, $roll_no, $email, $dob, $id_card, $gender, $session) {
            if ($this->isDuplicateEmail($email)) {
                return "Email already exists!";
            }

            $stmt = $this->conn->prepare("INSERT INTO students (name, father_name, roll_no, email, dob, id_card, gender, session) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssssss', $name, $father_name, $roll_no, $email, $dob, $id_card, $gender, $session);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        //check student
        public function studentCheck($email){
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows >0) {
            
                $row = $result->fetch_assoc();
                session_start();
                $stmt->close();
                return $row['email'];
            }else{
                $stmt->close();
                return false;
            }
            
        }

        //update student information
        public function updateStudent($name, $father_name, $dob, $id_card ,$student_email) {
                $stmt = $this->conn->prepare("UPDATE students SET name = ?, father_name = ?, dob = ?, id_card = ? WHERE email = ?");
            if (!$stmt) {
                return false;
            }
                $stmt->bind_param('sssss', $name, $father_name, $dob, $id_card, $student_email);
        
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        //Update profile picture 
        public function updateStudentPicture($picture , $id){
            $stmt = $this->conn->prepare("UPDATE students SET  picture = ? WHERE id = ?");
            $stmt->bind_param('ss',  $picture,$id);
        
            if ($stmt->execute()) {
                $stmt->close();
                return true; 
            } else {
                $stmt->close();
                return false; 
            }
        }

        // function return student of given email
        public function getStudentByEmail($email) {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE email = ?");
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

        //function return student of given session and roll no 
        public function getStudentByRollAndSssion($roll_no , $session) {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE roll_no = ? AND session=?");
            if (!$stmt) {
                return false;
            }
        
            $stmt->bind_param('ss', $roll_no , $session);
        
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
        
        
        //display student by session
        public function getStudentBySession($session) {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE session = ?");
            $stmt->bind_param('s', $session);
            $stmt->execute();
            $result = $stmt->get_result();
            $students = ['paid' => [], 'pending' => [], 'unpaid' => []];
            while ($row = $result->fetch_assoc()) {
                if ($row['fee_status'] === 'paid') {
                    $students['paid'][] = $row;
                } elseif ($row['fee_status'] === 'pending') {
                    $students['pending'][] = $row;
                } elseif ($row['fee_status'] === 'unpaid') {
                    $students['unpaid'][] = $row;
                }
            }
            $stmt->close();
            return $students;
        }

        //display student 
        public function getStudentsByYears($sessions) {
            $students = ['paid' => [], 'pending' => [], 'unpaid' => []];
            foreach ($sessions as $session) {
                $stmt = $this->conn->prepare("SELECT * FROM students WHERE session = ?");
                $stmt->bind_param('s', $session);
                $stmt->execute();
                $result = $stmt->get_result();
        
                while ($row = $result->fetch_assoc()) {
                    if ($row['fee_status'] === 'paid') {
                        $students['paid'][] = $row;
                    } elseif ($row['fee_status'] === 'pending') {
                        $students['pending'][] = $row;
                    } elseif ($row['fee_status'] === 'unpaid') {
                        $students['unpaid'][] = $row;
                    }
                }
                $stmt->close();
            }
            return $students;
        }

        //display 4 sessions student
        public function getLastFourSessions() {
            $stmt = $this->conn->prepare("SELECT DISTINCT session FROM students ORDER BY id DESC LIMIT 4");
            $stmt->execute();
            $result = $stmt->get_result();
            $sessions = [];

            while ($row = $result->fetch_assoc()) {
                $sessions[] = $row['session'];
            }
            $stmt->close();
            return $sessions;
        }

        //student login
        public function studentLogin($id_card, $dob, $remember_me) {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE id_card = ?");
            $stmt->bind_param('s', $id_card);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($dob === $row['dob']) {
                    // session_start();
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['picture'] = $row['picture'];
                    $_SESSION['fee_status'] = $row['fee_status'];
                    $_SESSION['session'] = $row['session'];
                    $_SESSION['roll_no'] = $row['roll_no'];
                    $_SESSION['father_name'] = $row['father_name'];
                    $_SESSION['id_s'] = $row['id'];
                    $_SESSION['due_date'] = $row['due_date'];
        
                    if ($remember_me) {
                        setcookie('email', $row['email'], time() + (7*24*60*60), "/");
                    }
        
                    $stmt->close();
                    return true;
                } else {
                    $stmt->close();
                    return false;
                }
            } else {
                $stmt->close();
                return false;
            }
        }

        //get only years for add session dropdown
        public function getYear(){
            $stmt = $this->conn->prepare("SELECT DISTINCT session FROM students ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $session = [];

            while ($row = $result->fetch_assoc()) {
                $session[] = $row['session'];
            }
            $stmt->close();
            return $session;
        }


        public function getUpdates()
        {

            $stmt = $this->conn->prepare("
                SELECT DISTINCT session
                FROM students
                ORDER BY id DESC
                LIMIT 4
            ");
            $stmt->execute();
            $result = $stmt->get_result();
        
            $sessions = [];
            while ($row = $result->fetch_assoc()) {
                $sessions[] = $row['session'];
            }
        
            if (empty($sessions)) {
                return [];
            }

            $details = [];
            foreach ($sessions as $session) {
                $stmt = $this->conn->prepare("
                    SELECT session, label, due_date
                    FROM students
                    WHERE session = ?
                    ORDER BY id ASC
                    LIMIT 1
                ");
                $stmt->bind_param('s', $session);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($row = $result->fetch_assoc()) {
 
                    $details[] = [
                        'session' => $row['session'],
                        'label' => $row['label'],
                        'due_date' => $row['due_date'],
                    ];
                }
            }
        
            return $details;
        }

        public function updateDueDate($sessionValue, $label, $due_date, $fee_status) {        
            $stmt = $this->conn->prepare("UPDATE students SET  due_date = ? , label = ? , fee_status = ? WHERE session = ?");
            $stmt->bind_param('ssss',  $due_date,$label, $fee_status, $sessionValue);
        
            if ($stmt->execute()) {
                $stmt->close();
                return true; 
            } else {
                $stmt->close();
                return false; 
            }
        }

        //insert update message
        public function message($subject , $message){
            $stmt = $this->conn->prepare("INSERT INTO message(subject , message) VALUES (?,?)");
            $stmt->bind_param('ss', $subject , $message);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        //get update message
        public function getUpdate(){
            $stmt = $this->conn->prepare("SELECT subject , message , date FROM message ORDER BY id DESC LIMIT 10");
            $stmt->execute();
            $result = $stmt->get_result();
            $updates = [];

            while ($row = $result->fetch_assoc()) {
                $updates[] = $row;
            }
            $stmt->close();
            return $updates;
        }

        public function insertComment($name,$email,$msg){
            $stmt = $this->conn->prepare("INSERT INTO comments (name , email, comment) VALUES (?,?,?)");
            $stmt->bind_param('sss' ,$name,$email,$msg );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function displayComments() {
            $stmt = $this->conn->prepare("SELECT * FROM comments ORDER BY id desc");
            if ($stmt && $stmt->execute()) {
                $result = $stmt->get_result();
                $comments = [];
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $comments[] = $row;
                    }
                }
        
                $stmt->close();
                return $comments; 
            }
        
            return false; 
        }
        
    }
?>