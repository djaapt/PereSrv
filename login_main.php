<link rel="shortcut icon" href="/images/favicon.ico" />
<?php
include_once '/media/dbinfo.php';
session_start(); //Starting Session
$error=''; //Variable to store error message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "<font color=\"#16C9C9\">Wrong Username or Password</font>";
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

<html>
<head>
<title>peresrv</title>
<link rel="icon" type="image/png" href="/images/favicon.png">
</head>
<body bgcolor="#000000">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B0B0B0">
<tr>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#344152">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="USERNAME" type="text" id="USERNAME"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="PASSWORD" type="password" id="PASSWORD"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
<tr><?php if(isset($error)){ echo "<td colspan='3'>$error</td>"; } ?></tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>