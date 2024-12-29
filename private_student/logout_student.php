<?php
session_start();
setcookie('email', $_SESSION['email'], time() - 3600, '/');
session_unset();
session_destroy();
header('Location: ../public/index.php');
exit();
?>