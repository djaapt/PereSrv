<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
session_start();
if(!session_is_registered(USER)){
header("location:main_login.php");
}
?>
<html>
<head>
<title>peresrv</title>
<link rel="icon" type="image/png" href="images/favicon.png">
<LINK href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
<div id='cssmenu'>
<ul>
   <li class='active '><a href="index.php"><span>Home</span></a></li>
   <li><a href="movies.php"><span>Movies</span></a></li>
   <li><a href="shows.php"><span>TVShows</span></a></li>
   <li><a href="music.php"><span>Music</span></a></li>
   <li><a href='#'><span>Other</span></a></li>
   <li><a href="settings.php"><span>Settings</span></a></li>
</ul>
</div>
</div>