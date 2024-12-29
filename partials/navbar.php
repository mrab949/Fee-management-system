<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/nav.css">
    <title>Nav Bar</title>
    <style>
       

    </style>
</head>
<body>
    <nav class="nav">
        <button class="menu-btn" id="menu-btn">&#9776;</button>
        <ul>
            <li class="nav-item">
                <a href="../private_admin/admin.php" class="nav-link"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a href="../private_admin/view_student.php" class="nav-link"><i class="fa fa-user-graduate"></i> Students</a>
            </li>
            <li class="nav-item">
                <a href="../private_admin/add_session.php" class="nav-link"><i class="fa fa-user-plus"></i> Add session</a>
            </li>
            <li class="nav-item">
                <a href="../private_admin/updates.php" class="nav-link"><i class="fas fa-sync-alt"></i> Updates</a>
            </li>
            <li class="nav-item">
                <a href="fee_challan.php" class="nav-link"><i class="fas fa-dollar-sign"></i> Generate voucher</a>
            </li>
            <!-- <li class="nav-item">
                <a href="../private_admin/announcement.php" class="nav-link"><i class="fa fa-bullhorn"></i> Announcements</a>
            </li> -->
            <li class="nav-item">
                <a href="../private_admin/profile_setting.php" class="nav-link"><i class="fa-solid fa-gear"></i> Profile setting</a>
            </li>     
            <li class="nav-item">
                <a href="../private_admin/help.php" class="nav-link"><i class="fas fa-hands-helping"></i> Help</a>
            </li>
        </ul>
    </nav>
    <script src="../assets/nav.js"></script>
</body>
</html>