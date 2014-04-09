<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include_once 'header.php'; ?>

<?php
//Build the connection to SQL server
include '/media/dbinfo.php';
$username = $_SESSION['username'];

//DB connection variable to call later
$db = new mysqli($HOST,$USER,$PASS,$DBASE);
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$TABLE = "members";
$sql = <<<SQL
    SELECT `Admin`
    FROM `$TABLE`
    WHERE `username` = "$username" 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
while($row = $result->fetch_assoc()){
	$var = $row['Admin'];
}
if($var = 1) {
echo "You are an Admin... Remember with great power comes great responsibility";
}
else{
echo "You are not an Admin... you poor poor thing";
}
?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once 'footer.php'; ?>