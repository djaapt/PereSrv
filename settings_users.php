<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<div id="info">
<form id='register' action='settings_user.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Register</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='name' >First Name*: </label>
<input type='text' name='name' id='name' maxlength="50" /><br><br>
<label for='name' >Last Name*: </label>
<input type='text' name='name' id='name' maxlength="50" /><br><br>
<label for='email' >Email Address*:</label>
<input type='text' name='email' id='email' maxlength="50" /><br><br>
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username' maxlength="50" /><br><br>
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>