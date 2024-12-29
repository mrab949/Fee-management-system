<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:../public/index.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>

    <?php
         require_once '../partials/header.php';
    ?>
    
    <div id="overlay"></div>

    <div class="toggleParent">
        <button class="button" id="toggleBtn" type="button"><i class="fa-solid fa-align-justify"></i></button>
    </div>

    <div class="container">

        <nav id="sidebar" class="sidebar">
            <i id="close-icon" class="fa fa-arrow-left"></i>
            <img src="../uploads/<?= $_SESSION['picture']?>" alt="Admin">
            <h2><?= $_SESSION['name']?></h2>
            <ul>
                <li><a href="../public/index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="fees.php"><i class="fa-solid fa-file-arrow-up"></i> Upload Challan</a></li>
                <li><a href="announcement.php"><i class="fa fa-bullhorn"></i> Announcement</a></li>
                <li><a href="profile_setting.php"><i class="fa-solid fa-gear"></i> Profile Setting</a></li>
                <li><a href="help.php"><i class="fas fa-hands-helping"></i> Help</a></li>
                <li><a href="logout_student.php" class="logoutBtn"><button class="logout"><i class="fas fa-sign-in-alt"></i> Log out</button></a></li>
            </ul>
        </nav>

        <div class="content" id="content">
            <h1 class="dashboard">Dashboard</h1>
            <div class="pages">
                <button class="page"><a href="fees.php"><i class="fa-solid fa-file-arrow-up"></i> Upload Challan</a></button>
                <button class="page"><a href="announcement.php"><i class="fa fa-bullhorn"></i> Announcement</a></button>
                <button class="page"><a href="profile_setting.php"><i class="fa-solid fa-gear"></i> Profile Setting</a></button>
                <button class="page"><a href="help.php"><i class="fas fa-hands-helping"></i> Help</a></button>
            </div>
            <?php
                 require_once('../partials/footer.php');
            ?>
           
        </div>
    </div>
    <script src="../assets/main.js"></script>
</body>

</html>