<?php
    session_start();
    if (!isset($_SESSION['a_email'])) {
        header('location:../public/index.php');
        exit();
    }

    require '../config/database.php';
    require '../classes/student.php';
    require '../classes/fees.php';

    $update = new student();
    $adminUpdate = $update->getUpdates();
    $fees = new fee();
    if (isset($_GET['email'])) {
        $student_email = $_GET['email'];
    } else {
        die("No student email provided!");
    }  

        
    $student = $update->getStudentByEmail($student_email);

    if (!$student) {
        die("Student not found!");
    }

    $roll_no = $student['roll_no'];
    $session = $student['session'];
    $feeinfo= $fees->getStudentFeeDetails($session, $roll_no);
    $lastinfo =( $feeinfo ) ? end($feeinfo): null; 

    if (!isset($student['due_date']) || !$student['due_date']) {
        $student['due_date'] = "Please update";
    }else{
        $duedate = $student['due_date'];
        $currentdate = date('Y-m-d');
        if((strtotime($duedate)<strtotime($currentdate)) && ($student['fee_status'] == 'unpaid')){
            $overdue = "red";
        }else{
            $overdue = "";
        }
    }

    if(($student['fee_status'] === 'paid') || ($student['fee_status']=== 'unpaid')){
        $disable = "disable";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form_type = $_POST['form_type'] ?? null;

        if ($form_type === 'status') {
            handleStatusUpdate($fees, $roll_no, $session, $lastinfo);
        } elseif ($form_type === 'data') {
            handleDataUpdate($update);
        } elseif($form_type === 'date'){
            handleDateUpdate($fees, $roll_no, $session, $lastinfo);
        }
    }

    function handleStatusUpdate($fees, $roll_no, $session, $lastinfo) {
        
        $update = new student();
        $student_email = $_GET['email'];
        $student = $update->getStudentByEmail($student_email);

        $adminInput = $_POST['status'] ?? '';
        $fee_status = ($adminInput === 'accept') ? 'paid' : 'unpaid';
        $subject = ($adminInput === 'accept') ? "Your Challan Has Been Accepted" : "Your Challan Has Been Rejected";
        $message = "Dear {$student['name']},<br><br>" .
            ($adminInput === 'accept'
                ? "We are pleased to inform you that your fee challan for {$lastinfo['semester']} has been <strong>Accepted</strong>.<br>Your payment has been successfully processed."
                : "We regret to inform you that your fee challan for {$lastinfo['semester']} has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.")
            . "<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan";

        if ($fees->updateFeeStatus($fee_status, $roll_no, $session, $lastinfo['semester'])) {
            if ($adminInput === 'reject' && !$fees->deleteChallan($roll_no, $session, $lastinfo['semester'])) {
                echo '<script>alert("Error deleting challan.");</script>';
            }

            if ($fees->insertChallanMsg($roll_no, $session, $subject, $message)) {
                echo "<script>alert('Challan {$adminInput}ed successfully and message sent!');</script>";
            } else {
                echo "<script>alert('Challan {$adminInput}ed but message sending failed.');</script>";
            }
        } else {
            echo '<script>alert("Error updating fee status.");</script>';
        }
    }

    function handleDataUpdate($update) {
        $name = $_POST['name'] ?? '';
        $father_name = $_POST['father_name'] ?? '';
        // $email = $_POST['email'] ?? '';
        $dob = $_POST['dob'] ?? '';
        $id_card = $_POST['id_card'] ?? '';
        if (isset($_GET['email'])) {
            $student_email = $_GET['email'];
        } else {
            die("No student email provided!");
        }  
        $update = new student();
        $student = $update->getStudentByEmail($student_email);

        if ($update->updateStudent($name, $father_name, $dob, $id_card ,$student_email)) {
            echo '<script>alert("Student data updated successfully!");</script>';

        } else {
            echo '<script>alert("Error updating student data.");</script>';
        }
    }

    function handleDateUpdate($fees, $roll_no, $session, $lastinfo){
        $date = $_POST['due_date'] ?? '';
        $currentdate = date('Y-m-d');
        if((strtotime($date) < strtotime($currentdate))){
            echo '<script>alert("Due date cannot be in the past.");</script>'; 
        }else{
            if ($fees->updateFeeDueDate($date , $roll_no , $session)) {
                echo '<script>alert("Due date extended successfully!");</script>';
            }else{
                echo '<script>alert("Error extending due date.");</script>';
            }
        }

       
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/s_profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Student Profile</title>
    <style>
        .status.red {
            background-color: red;
        }
        button.disable{
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <?php 
        require '../partials/header.php';

        require '../partials/navbar.php';

    ?>

    <div class="main">
        <div class="profile">
                <div class="pic">
                    <img src="../uploads/<?=$student['picture']?>" alt="Profile Picture">
                    <h1><?=$student['name']?></h1>
                </div>
                <div class="detail">
                    <h1 class="profile-title">About</h1>
                    <table class="profile-table">
                        <tr>
                            <td class="profile-label">Name:</td>
                            <td class="profile-value"><?=$student['name']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Father Name:</td>
                            <td class="profile-value"><?=$student['father_name']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Email:</td>
                            <td class="profile-value"><?=$student['email']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Roll No:</td>
                            <td class="profile-value"><?=$student['roll_no']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Semester:</td>
                            <td class="profile-value"><?=$student['label']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Session:</td>
                            <td class="profile-value"><?=$student['session']?></td>
                        </tr>
                    </table>
                </div>

        </div>

        <div class="action">
            <h1>Actions</h1>
            <div class="action">
            <button class="status <?=$student['fee_status']?>">Current Semester Fee: <?=$student['fee_status']?></button>
            <button onclick="toggleDropdown()" class="<?=$$disable?>">Update Status</button>
            <div class="dropdown" id="statusDropdown" style="display:none;">
                <form action="s_profile.php?email=<?=$student_email?>" method="POST">
                    <input type="hidden" name="form_type" value="status">
                    <select name="status" id="status-select" onchange="this.form.submit();">
                        <option value="" disabled selected>Select Status</option>
                        <option value="accept">Accept</option>
                        <option value="reject">Reject</option>
                    </select>
                </form>
            </div>
            <button onclick="openPopup()">Update Information</button>
            <button class="status <?=$overdue?>" onclick="openDate()">Due date: <?=$student['due_date']?></button>
            </div>       
        </div>    

        <div class="container">
            <h1>Paid Fee History</h1>
            <table>
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Payment Date</th>
                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th>Challan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($feeinfo)) : ?>
                        <?php foreach ($feeinfo as $data) : ?>
                            <tr>
                                <td><?=$data['session']?></td>
                                <td><?=$data['semester']?></td>
                                <td><?=$data['uploaded_date']?></td>
                                <td><?=$data['amount']?></td>
                                <td><?=$data['fee_status'] ?></td>
                                <td><button class="view-challan" onclick="showChallan('<?= $data['challan']?>')">View Challan</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">You have not paid yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="popup" id="infoPopup" style="display:none;">
        <div class="form-container">
            <span class="close"  onclick="closePopup()">X</span>
            <h2>Update Information</h2>
            <form action="s_profile.php?email=<?=$student_email?>" method="post">
                <input type="hidden" name="form_type" value="data">
                <input type="text" placeholder="Name" name="name" required>
                <input type="text" placeholder="Father's Name" name="father_name" required>
                <!-- <input type="email" placeholder="Email" name="email" required> -->
                <input type="date" placeholder="Date of Birth" name="dob" required>
                <input type="text" placeholder="CNIC" name="id_card" maxlength="13" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="popup" id="datePopup" style="display:none;">
        <div class="form-container">
        <span class="close"  onclick="closeDate()">X</span>
        <h2>Extend Due Date for <?=$student['name']?></h2>
            <form action="s_profile.php?email=<?=$student_email?>" method="post">
                <input type="hidden" name="form_type" value="date">
                <input type="date" name="due_date" id="" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="challan-popup" id="challanPopup" style="display:none;">
        <div class="challan-container">
            <span class="close" style="color:white;" onclick="closeChallanPopup()">X</span>
            <img id="challanImage" src="" alt="Challan" style="width:100%; max-height: 80vh;">
        </div>
    </div>

    <script src="../assets/s_profile.js">
       
    </script>
</body>

</html>