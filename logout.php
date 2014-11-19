<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
	header("location:main_login.php");
}
?>