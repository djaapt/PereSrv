<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
include_once 'config.php';
session_start();
if(!session_is_registered('USER')){
header("location:".BASEURL."/main_login.php");
}
?>
<html>
<head>
<title>peresrv</title>
<link rel="icon" type="image/png" href="<?php BASEURL; ?>/images/favicon.png">
<link href="<?php BASEURL; ?>/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
<div id='cssmenu'>
<ul>
   <li class='active'><a href="<?php BASEURL; ?>/index.php"><span>Home</span></a></li>
   <li><a href="<?php BASEURL; ?>/movies.php"><span>Movies</span></a></li>
   <li><a href="<?php BASEURL; ?>/shows.php"><span>TVShows</span></a></li>
   <li><a href="<?php BASEURL; ?>/music.php"><span>Music</span></a></li>
   <li><a href='#'><span>Other</span></a></li>
   <li><a href="<?php BASEURL; ?>/settings/settings.php"><span>Settings</span></a></li>
   <li style="float: right;"><a href="<?php BASEURL; ?>/logout.php"><span>Logout</span></a></li>
</ul>
</div>
</div>