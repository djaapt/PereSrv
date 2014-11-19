<link rel="shortcut icon" href="/images/favicon.ico" />
<?php
include('login_script.php'); // Includes login script
?>
<!DOCTYPE html>
<html>
<head>
<title>peresrv</title>
<link rel="icon" type="image/png" href="/images/favicon.png">
</head>
<body bgcolor="#000000">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B0B0B0">
<tr>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#344152">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="username" type="text" id="username"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="password" type="password" id="password"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="Login"></td>
</tr>
<tr><?php echo "<td colspan='3'>$error</td>"; ?></tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>