<?php

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
$sql="SELECT * FROM $TABLE WHERE username='$USER' and password='$PASS'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $USER and $PASS, table row must be 1 row
if($count==1){

// Register $USER, $PASS and redirect to file "login_success.php"
session_register("USER");
session_register("PASS"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
?>