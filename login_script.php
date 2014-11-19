<link rel="shortcut icon" href="/images/favicon.ico" />
<?php
include('/media/dbinfo.php');
session_start(); //Starting Session
$error=""; //Variable to store error message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "<font color=\"#16C9C9\">Username or Password is blank</font>";
	}
	else {
		//Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		//Establishing connection to MySQL
		$TABLE = "members"; // Table name 
		$connection = mysql_connect("$HOST", "$USER", "$PASS");
		// To protect MySQL injection (more detail about MySQL injection)
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$password = md5($password);
		// Selecting Database
		$db = mysql_select_db("$DBASE", $connection)or die("cannot select DB");
		// SQL query to fetch information of registerd users and finds user match.
		$SQL = mysql_query("SELECT * FROM $TABLE WHERE username='$username' and password='$password'", $connection);
		$rows = mysql_num_rows($SQL);
		if ($rows == 1) {
			$_SESSION['login_user']=$username; //Initializing Session
			header('location:index.php'); //Redirecting to main webpage
		}
		else {
			$error = "<font color=\"#16C9C9\">Wrong Username or Password</font>";
		}
	mysql_close($connection); //Closing connection
	}
}
?>