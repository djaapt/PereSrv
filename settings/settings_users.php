<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include_once '../header.php'; 
include_once '/media/dbinfo.php';
$FIRSTNAME = check_input($_POST['FirstName'],"Enter First Name!");
$LASTNAME = check_input($_POST['LastName'],"Enter Last Name!");
$USERNAME = check_input($_POST['username'],"Enter Userame!");
$PASSWORD = check_input($_POST['password'],"Enter Password!");
$EMAIL = check_input($_POST['Email'],"Enter Email Address!");
$MAXRATING = check_input($_POST['MaxRating']);
$ADMIN = check_input($_POST['Admin']);
?>

<div id="info">
<form id='register' action='settings_users.php?user' method='post'>
<legend>Register</legend>
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
</select>
<input type='checkbox' name='Admin' value="1">Administrator<br><br>
<input type='submit' name='Submit' value='Submit' />
</form>

<?php
function check_input($DATA, $ERROR='')
{
    $DATA = trim($DATA);
    $DATA = stripslashes($DATA);
    $DATA = htmlspecialchars($DATA);
	if ($ERROR && strlen($DATA) == 0)
	{
		die($ERROR);
	}
    return $DATA;
}
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once BASEPATH.'/footer.php'; ?>