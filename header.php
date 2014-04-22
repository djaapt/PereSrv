<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
include_once 'config.php';
session_start();
if(!session_is_registered('USERNAME')){
header("location:main_login.php");
}
?>
<html>
<head>
<title>peresrv</title>
<link rel="icon" type="image/png" href="/images/favicon.png">
<link href="/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
<div id='cssmenu'>
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
if($var==1) {
echo '<ul>';
echo '<li class="active"><a href="/index.php"><span>Home</span></a></li>';
echo '<li><a href="/movies.php"><span>Movies</span></a></li>';
echo '<li><a href="/shows.php"><span>TVShows</span></a></li>';
echo '<li><a href="/music.php"><span>Music</span></a></li>';
echo '<li><a href="#"><span>Other</span></a></li>';
echo '<li><a href="/settings/settings.php"><span>Settings</span></a></li>';
echo '<li style="float: right;"><a href="/logout.php"><span>Logout</span></a></li>';
echo '</ul>';
}
else{
echo '<ul>';
echo '<li class="active"><a href="/index.php"><span>Home</span></a></li>';
echo '<li><a href="/movies.php"><span>Movies</span></a></li>';
echo '<li><a href="/shows.php"><span>TVShows</span></a></li>';
echo '<li><a href="/music.php"><span>Music</span></a></li>';
echo '<li><a href="#"><span>Other</span></a></li>';
echo '<li style="float: right;"><a href="/logout.php"><span>Logout</span></a></li>';
echo '</ul>';
}
?>
</div>
</div>