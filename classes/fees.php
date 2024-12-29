<?php

    // require '../config/database.php';
    // require '../classes/student.php';
    require '../classes/admin.php';

    class fee extends database{

        public function insertFees($roll_no, $session, $semester, $amount, $destPath) {
           
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE roll_no = ? AND session = ?");
            $stmt->bind_param('ss', $roll_no, $session);
            $stmt->execute();
            $result = $stmt->get_result();         
            
            if ($result->num_rows === 0) {
                $stmt->close();
                return false; 
            }

            $stmt = $this->conn->prepare("SELECT * FROM challan WHERE roll_no = ? AND session = ? AND semester=?");
            $stmt->bind_param('sss', $roll_no, $session,$semester);
            $stmt->execute();
            $result = $stmt->get_result();         
            
            if ($result->num_rows > 0) {
                $stmt->close();
                return false; 
            }

            $stmt = $this->conn->prepare("INSERT INTO challan (roll_no, session, semester, amount, challan) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssis', $roll_no, $session, $semester, $amount, $destPath);
            
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        public function getStudentFeeDetails($session, $roll_no) {
            $stmt = $this->conn->prepare("SELECT * FROM challan WHERE roll_no = ? AND session = ?");
            $stmt->bind_param('ss', $roll_no, $session);
            $stmt->execute();
            $result = $stmt->get_result();         
            // $data[]="";
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()){
                    $data[]=$row;
                }
                $stmt->close();
                return $data; 
            }

            return false;
        }


        // public function getStudentFeeDetails($session, $roll_no) {
        //     // Validate input parameters
        //     if (empty($session) || empty($roll_no)) {
        //         return false;
        //     }
        
        //     // SQL query
        //     $sql = "SELECT 
        //                 s.roll_no,
        //                 s.name,
        //                 c.semester,
        //                 s.session,
        //                 c.uploaded_date AS payment_date,
        //                 c.amount,
        //                 c.fee_status,
        //                 c.challan,
        //                 s.due_date,
        //                 s.label,
        //                 s.picture
        //             FROM 
        //                 students s
        //             INNER JOIN 
        //                 challan c
        //             ON 
        //                 s.roll_no = c.roll_no
        //             WHERE 
        //                 s.session=? AND s.roll_no = ?
        //             ORDER BY 
        //                 c.id ASC";
        
        //     $stmt = $this->conn->prepare($sql);
        
        //     if ($stmt) {
        //         $stmt->bind_param('ss', $session, $roll_no);
        
        //         if ($stmt->execute()) {
        //             $result = $stmt->get_result();
        //             $data = [];
        //             while ($row = $result->fetch_assoc()) {
        //                 $data[] = $row;
        //             }
        //             return $data;
        //         } else {
        //             error_log("Error executing query: " . $stmt->error);
        //             return false;
        //         }
        //     } else {
        //         error_log("Error preparing statement: " . $this->conn->error);
        //         return false;
        //     }
        // }








        public function updateFeeStatus($fee_status , $roll_no , $session, $semester){
            $stmt1 = $this->conn->prepare("UPDATE students SET fee_status = ? WHERE roll_no=? AND session = ?") ;
            $stmt2 = $this->conn->prepare("UPDATE challan SET fee_status = ? WHERE roll_no=? AND session = ? AND semester=?") ;
            $stmt1->bind_param('sss' , $fee_status , $roll_no , $session);
            $stmt2->bind_param('ssss' , $fee_status , $roll_no , $session, $semester);
            if ($stmt1->execute() && $stmt2->execute()) {
                $stmt1->close();
                $stmt2->close();
                return true;
            } else {
                $stmt1->close();
                $stmt2->close();
                return false;
            }
        }

        public function updateFeeDueDate($date , $roll_no , $session){
            $stmt1 = $this->conn->prepare("UPDATE students SET due_date = ? WHERE roll_no=? AND session = ?") ;
            $stmt1->bind_param('sss' , $date , $roll_no , $session);
            if ($stmt1->execute()) {
                $stmt1->close();
                return true;
            } else {
                $stmt1->close();
                return false;
            }
        }

        public function deleteChallan( $roll_no , $session, $semester){
            $stmt = $this->conn->prepare("DELETE FROM challan  WHERE roll_no=? AND session = ? AND semester=?") ;
            $stmt->bind_param('sss' , $roll_no , $session, $semester);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        public function insertChallanMsg( $roll_no,$session,$subject, $message){
            $stmt = $this->conn->prepare("INSERT INTO  challanMsg(roll_no, session , subject ,message) VALUES(?,?,?,?)") ;
            $stmt->bind_param('ssss' , $roll_no,$session,$subject, $message);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        public function getChallanMsg($roll_no, $session){
            $stmt = $this->conn->prepare("SELECT subject , message , date FROM challanmsg WHERE roll_no= ? AND session = ? ORDER BY id DESC LIMIT 8");
            $stmt->bind_param('ss', $roll_no, $session);
            $stmt->execute();
            $result = $stmt->get_result();
            $updates = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg[] = $row;
                }
                $stmt->close();
                return $msg;
            }
        }
    }
?>