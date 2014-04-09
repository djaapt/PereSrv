<body bgcolor="#000000">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B0B0B0">
<tr>
<form name="form1" method="post" action="main_login.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#16C9C9">
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
</table>
</td>
</form>
</tr>
</table>
<?php
$error = "<font color=\"#16C9C9\">Wrong Username or Password</font>";
//Build the connection to SQL server
include_once '/media/dbinfo.php';
$TABLE = "members"; // Table name 

// Connect to server and select databse.
mysql_connect("$HOST", "$USER", "$PASS")or die("cannot connect"); 
mysql_select_db("$DBASE")or die("cannot select DB");

// username and password sent from form 
$USERNAME=$_POST['USERNAME']; 
$PASSWORD=$_POST['PASSWORD']; 

// To protect MySQL injection (more detail about MySQL injection)
$USERNAME = stripslashes($USERNAME);
$PASSWORD = stripslashes($PASSWORD);
$USERNAME = mysql_real_escape_string($USERNAME);
$PASSWORD = mysql_real_escape_string($PASSWORD);
$PASSWORD = md5($PASSWORD);
$SQL="SELECT * FROM $TABLE WHERE username='$USERNAME' and password='$PASSWORD'";
$result=mysql_query($SQL);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $USERNAME and $PASSWORD, table row must be 1 row
if($count==1){
	// Register $USERNAME, $PASSWORD and redirect to file "index.php"
	session_start();
	$_SESSION['username'] = $USERNAME;
	session_register("USERNAME"); 
	session_register("PASSWORD"); 
	header("location:index.php");
}
if(isset($error)) {
    echo $error;
}
?>
</body>