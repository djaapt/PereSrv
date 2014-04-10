<?php
session_start();
session_unset();
session_destroy();

header("location:/main_login.php");
exit();
?>