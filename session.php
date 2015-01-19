<?php
include('config.php');
include('/media/dbinfo.php');
$TABLE = "members"; // Table name
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("$HOST", "$USER", "$PASS");
// Selecting Database
$db = mysql_select_db("$DBASE", $connection)or die("cannot select DB");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = mysql_query("select username from $TABLE where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session = $row['username'];
if(!isset($login_session)){
	mysql_close($connection); // Closing Connection
	header("location: ".BASEURL."/main_login.php"); // Redirecting To Home Page
}
?>