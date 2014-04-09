<?php include_once 'config.php';?>
<body bgcolor="#000000">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B0B0B0">
<tr>
<form name="form1" method="post" action="main_login.php?login=1">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#16C9C9">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="USER" type="text" id="USER"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="PASS" type="password" id="PASS"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<?php
if (isset ($_REQUEST[''])) {
	$LOGIN = $_REQUEST['login'];
	if ($LOGIN == 1) {
		//Build the connection to SQL server
		include '/media/dbinfo.php';
		$TABLE = "members"; // Table name 

		// Connect to server and select databse.
		mysql_connect("$HOST", "$USER", "$PASS")or die("cannot connect"); 
		mysql_select_db("$DBASE")or die("cannot select DB");

		// username and password sent from form 
		$USER=$_POST['USER']; 
		$PASS=$_POST['PASS']; 

		// To protect MySQL injection (more detail about MySQL injection)
		$USER = stripslashes($USER);
		$PASS = stripslashes($PASS);
		$USER = mysql_real_escape_string($USER);
		$PASS = mysql_real_escape_string($PASS);
		$PASS = md5($PASS);
		$SQL="SELECT * FROM $TABLE WHERE username='$USER' and password='$PASS'";
		$result=mysql_query($SQL);

		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);

		// If result matched $USER and $PASS, table row must be 1 row
		if($count==1){

		// Register $USER, $PASS and redirect to file "index.php"
		session_start();
		$_SESSION['username'] = $USER;
		session_register("USER"); 
		session_register("PASS"); 
		header("location:index.php");
		}
	}
	else {
		echo "<font color=\"#16C9C9\">Wrong Username or Password</font>";
	}
}
?>
</body>