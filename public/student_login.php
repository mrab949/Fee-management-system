<?php

require_once('../config/database.php');
require '../classes/student.php';

$student = new student();
session_start();
if(isset($_COOKIE['email']) && ($_SESSION['l_email'] === $_COOKIE['email'])){
    $email = $_COOKIE['email'];
    $row = $student->getStudentByEmail($email);
    if ($row) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['roll_no'] = $row['roll_no'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['session'] = $row['session'];
        $_SESSION['father_name'] = $row['father_name'];
        $_SESSION['id_s'] = $row['id'];
        header('location: ../private_student/student.php');
        exit();
    }
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cnic = $_POST['cnic'];
    $dob = $_POST['dob'];
    
   
    $remember_me = isset($_POST['remember_me'])? true :false;
    if($student->studentLogin($cnic , $dob, $remember_me)){
        echo  "
        <script>
            window.location.href = '../private_student/student.php';
        </script>";
    }else{
        $error = "No student Found.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/login.css">
  
</head>

<body>
    <?php
        require '../partials/header.php';
    ?>

    <div class="background"></div>

    <form action="student_login.php" method="POST"  class="form">
        <h1>Login</h1>

        <div class="form-group">
            <label for="cnic" class="form-label">
                <i class="fas fa-id-card"></i> CNIC:
            </label>
            <input type="text" id="cnic" name="cnic" class="box" placeholder="1234512345671" maxlength="13">
        </div>

        <div class="form-group">
            <label for="dob" class="form-label">
                <i class="fas fa-calendar-day"></i> Date of Birth:
            </label>
            <input type="date" id="dob" name="dob" class="box" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberme" name="remember_me">
            <label class="form-check-label" for="rememberme">Remember me</label>
        </div>
        <p style="width: 90%; color:red; margin-top:1rem; padding:5px; border:none; border-radius:6px;"><?= $error ?></p>        <button id="submit" type = "submit">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>

    <?php
        require '../partials/footer.php';
    ?>
</body>

</html>
