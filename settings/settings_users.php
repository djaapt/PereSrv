<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include_once '../header.php'; 
include_once '/media/dbinfo.php';
?>

<div id="info">
<form name='New User' method='post' action='settings_users.php?adding=1'>
<legend>Register New User</legend><br>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='FirstName' >First Name*: </label>
<input type='text' name='FirstName' id='FirstName' maxlength="50" /><br><br>
<label for='LastName' >Last Name*: </label>
<input type='text' name='LastName' id='LastName' maxlength="50" /><br><br>
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username' maxlength="50" /><br><br>
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" /><br><br>
<label for='Email' >Email Address*:</label>
<input type='text' name='Email' id='Email' maxlength="50" /><br><br>
<label for='MaxRating' >MaxRating:</label>
<select name='MaxRating'>
	<option value="100" selected>All</option>
</select><br><br>
<input type='checkbox' name='Admin' value="1">Administrator<br><br>
<input type='submit' value='Add' />
</form>

<?php
//DB connection variable to call later
$TABLE = "members";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

if (isset ($_REQUEST['adding'])) {
	$ADDING = $_REQUEST['adding'];
	if ($ADDING == 1) {
		//Check for duplicate username
		$QUERY = "select * from $TABLE where username='" . htmlspecialchars($_POST['username']) . "'";
		$RESULT = mysqli_query($DBC,$QUERY);
		if (mysql_num_rows($RESULT) >= 1) {	
			$DUPERROR = "Please enter another Username";
		}
		else { $DUPERROR = "Enter Username!";}
		$FIRSTNAME = check_input($_POST['FirstName'],"Enter First Name!");
		$LASTNAME = check_input($_POST['LastName'],"Enter Last Name!");
		$USERNAME = check_input($_POST['username'],$DUPERROR);
		$PASSWORD = check_input(md5($_POST['password']),"Enter Password!");
		$EMAIL = check_input($_POST['Email'],"Enter Email Address!");
		$MAXRATING = check_input($_POST['MaxRating']);
		$ADMIN = check_input($_POST['Admin']);
	}
}
function check_input($DATA, $ERROR=''){
    $DATA = trim($DATA);
    $DATA = stripslashes($DATA);
    $DATA = htmlspecialchars($DATA);
	if ($ERROR && strlen($DATA) == 0){
		die($ERROR);
	}
    return $DATA;
}
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once BASEPATH.'/footer.php'; ?>