<?php
session_start();
setcookie('a_email', $_SESSION['a_email'], time() - 3600, '/');
session_unset();
session_destroy();
header('Location: ../public/index.php');
exit();
?>