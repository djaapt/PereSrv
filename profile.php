<link rel="shortcut icon" href="/images/favicon.ico" />
<?php
include('header.php'); // Includes header
?>
<div id="info">
Your Home Page <br><br>
Welcome:<?php echo $login_session; ?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once 'footer.php'; ?>