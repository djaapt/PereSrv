<?php
session_start();
session_unset();
session_destroy();

header("location:https://djaapt.com:8443/main_login.php");
exit();
?>