<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Admin Dashboard</title>

    
</head>

<body>
    <?php require_once '../partials/header.php'; ?>
    <div id="overlay"></div>
    <div class="toggleParent">
        <button class="button" id="toggleBtn" type="button"><i class="fa-solid fa-align-justify"></i></button>
    </div>

    <div class="container">
        <nav id="sidebar" class="sidebar">
            <i id="close-icon" class="fa fa-arrow-left"></i>           
            <img src="<?=$_SESSION['a_picture']?>" alt="Admin" class="profile-img">
            <h2 class="admin-name"><?=$_SESSION['a_name']?></h2>
            <ul>
                <li><a href="../public/index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="view_student.php"><i class="fa fa-user-graduate"></i> Students</a></li>
                <li><a href="add_session.php"><i class="fa fa-user-plus"></i> Add Session</a></li>
                <li><a href="updates.php"><i class="fas fa-sync-alt"></i> Updates</a></li>
                <li><a href="fee_challan.php"><i class="fas fa-dollar-sign"></i> Generate voucher</a></li>
                <li><a href="profile_setting.php"><i class="fa-solid fa-gear"></i> Profile Settings</a></li>
                <li><a href="help.php"><i class="fas fa-hands-helping"></i> Help</a></li>
                <li><a href="logout_admin.php" class="logoutBtn"><button class="logout"><i class="fas fa-sign-in-alt"></i> Log out</button></a></li>
            </ul>
        </nav>

        <div class="content" id="content">
            <h1 class="dashboard">Admin Dashboard</h1>
            <div class="pages">
                <button class="page"><a href="view_student.php"><i class="fa fa-user-graduate"></i> Students</a></button>
                <button class="page"><a href="add_session.php"><i class="fa fa-user-plus"></i> Add Session</a></button>
                <button class="page"><a href="profile_setting.php"><i class="fa-solid fa-gear"></i> Profile Settings</a></button>
                <button class="page"><a href="updates.php"><i class="fas fa-sync-alt"></i> Updates</a></button>
                <button class="page"><a href="fee_challan.php"><i class="fas fa-receipt"></i> Generate voucher</a></button>
                <button class="page"><a href="help.php"><i class="fas fa-hands-helping"></i> Help</a></button>
            </div>
            <?php require_once('../partials/footer.php'); ?>
        </div>
    </div>

   
</body>

</html>
