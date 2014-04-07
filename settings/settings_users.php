<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; 
$FIRSTNAME = check_input($_POST['FirstName']);
$LASTNAME = check_input($_POST['LastName']);
$USERNAME = check_input($_POST['username']);
$PASSWORD = check_input($_POST['password']);
$EMAIL = check_input($_POST['Email']);
$MAXRATING = check_input($_POST['MaxRating']);
$ADMIN = check_input($_POST['Admin']);
?>

<div id="info">
<form id='register' action='settings_users.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Register</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='name' >First Name*: </label>
<input type='text' name='FirstName' id='FirstName' maxlength="50" /><br><br>
<label for='name' >Last Name*: </label>
<input type='text' name='LastName' id='LastName' maxlength="50" /><br><br>
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username' maxlength="50" /><br><br>
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />
<label for='email' >Email Address*:</label>
<input type='text' name='Email' id='Email' maxlength="50" /><br><br>
<label for='name' >Max Rating*: </label>
<input type='text' name='MaxRating' id='MaxRating' maxlength="50" /><br><br>
<label for='name' >Administrator?*: </label>
<input type='text' name='Admin' id='Admin' maxlength="50" /><br><br>
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>

<?php
function check_input($DATA){
    $DATA = trim($DATA);
    $DATA = stripslashes($DATA);
    $DATA = htmlspecialchars($DATA);
    return $DATA;
}
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include BASEPATH.'/footer.php'; ?>