<link rel="shortcut icon" href="/images/favicon.ico" />
<?php
include('header.php'); // Includes header
?>
<div id="info">
<br><br>
Welcome: <?php echo $login_session; ?><br><br>

<div id="info">
<form name='Password Change' method='post' action='changepass.php?adding=1'>
	<legend>Change Password Below</legend><br>
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<label for='CurrentPassword' >Current Password*: </label>
	<input type='currentpassword' name='currentpassword' id='currentpassword' maxlength="50" /><br><br>
	<label for='NewPassowrd' >New Password*: </label>
	<input type='newpassword' name='newpassword' id='newpassword' maxlength="50" /><br><br>
	<label for='username' >Confirm New Password*:</label>
	<input type='confirmpassword' name='confirmpassword' id='confirmpassword' maxlength="50" /><br><br>
	<input type='submit' name='submit' value='Change Password' />
</form>

<?php
//DB connection variable to call later
$TABLE = "members";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

if (isset ($_POST['submit'])) {
	$ADDING = $_REQUEST['submit'];
	if ($ADDING == 'Add') {
		$CurrentPassword = check_input(md5(	$_POST['currentpassword']),"Enter Current Password!");
		$NEWPASSWORD = check_input(md5($_POST['newpassword']),"Enter Password!");
		$CONFIRMPASSWORD = check_input(md5($_POST['confirmpassword']),"Enter Password!");
		
		//Build insert statement
		$QUERY = "insert into $TABLE values(NULL,'$USERNAME','$PASSWORD','$FIRSTNAME','$LASTNAME','$EMAIL',DEFAULT,DEFAULT,'$ADMIN')";
		//Add user to DB
		mysqli_query($DBC,$QUERY);
		die("User Added to Database");
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
include_once 'footer.php'; ?>