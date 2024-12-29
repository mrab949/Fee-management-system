<?php

require_once('../config/database.php');
require '../classes/student.php';
require '../classes/admin.php';

// session_start();

$admin= new admin();
$student = new student();
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){  
    $email = $_POST['email'];
    
    if($student->studentCheck($email)){
        $_SESSION['l_email'] = $email;
        echo "<script>window.location.href = 'student_login.php';</script>";
    }else if($admin->adminCheck($email)){
        session_start();
        $_SESSION['al_email'] = $email;
        echo "<script>window.location.href = 'admin_login.php';</script>";
    }else{
        $error = "You are not a member";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check user</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/login.css">
</head>

<body>
    <?php
        require '../partials/header.php';
    ?>

    <!-- <div class="background"></div> -->
    <form action="check_user.php" method="POST"  class="form">
        <h1>WELCOME</h1>

        <div class="form-group">
            <label for="email" class="form-label">
            <i class="fa-solid fa-envelope" style="color: rgb(231, 111, 81);"></i> Email:
            </label>
            <input type="email" id="email" name="email" placeholder="Enter your email" class="box" required>
        </div>
        <p style="width: 90%; color:red; margin-top:1rem; padding:5px; border:none; border-radius:6px;"><?= $error ?></p>       
        <button id="submit" type = "submit">
        <i class="fas fa-sign-in-alt"></i> Continue
        </button>
    </form>

    <?php
        require '../partials/footer.php';
    ?>
</body>

</html>
