<?php

require_once('../config/database.php');

require '../classes/admin.php';

$admin = new admin();

session_start();

if ((isset($_COOKIE['a_email'])) && ( $_SESSION['al_email'] === $_COOKIE['a_email'])) {

    $email = $_COOKIE['a_email'];

    $row = $admin->getAdminByEmail($email);

    print_r($row);

    if ($row) {

        $_SESSION['a_name'] = $row['name'];

        $_SESSION['a_email'] = $row['email'];

        $_SESSION['a_picture'] = $row['picture'];

        $_SESSION['id'] = $row['id'];

        header('Location: ../private_admin/admin.php');

        exit();

    }

}



$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['name'];

    $password = $_POST['password'];

    $remember_me = isset($_POST['remember_me'])? true :false;

    if($admin->adminLogin($name , $password , $remember_me)){

        

        echo  "

        <script>

            window.location.href = '../private_admin/admin.php';

        </script>";

        

    }else{

         $error = "Account not found..";

    }

}



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../assets/login.css">

</head>



<body>

    <div class="background"></div>



    <?php

        require '../partials/header.php';

    ?>



    <form action="admin_login.php" method = "POST" class="form">

        <h1>Login</h1>

        <div class="form-group">

            <label for="name" class="form-label">

                <i class="fas fa-user"></i> Name:

            </label>

            <input type="text" name="name" id="name" placeholder="Enter your Name" class="box" required>

        </div>



        <div class="form-group">

            <label for="password" class="form-label">

                <i class="fas fa-lock"></i> Password:

            </label>

            <input type="password" name="password" id="password" class="box" placeholder="Enter Password" required>

        </div>



        <div class="form-check">

            <input type="checkbox" class="form-check-input" id="rememberme" name="remember_me">

            <label class="form-check-label" for="rememberme">Remember me</label>

        </div>

        <p style="width: 90%; color:red; margin-top:1rem; padding:5px; border:none; border-radius:6px;"><?= $error ?></p>

        <button type = "submit" id="submit">

            <i class="fas fa-sign-in-alt"></i> Login

        </button>

    </form>



    <?php

        require '../partials/footer.php';

    ?>

</body>



</html>
