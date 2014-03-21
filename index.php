<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<div id="info">
<div class="bubble"></div>
<div class="bubble">
<div class="shows">
<table align="center">
<tr>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

$query="SELECT showname FROM $TABLE ORDER BY RAND() LIMIT 10";
if($query_run=mysqli_query($DBC,$query))
{
    $i=11;
    $rows=mysqli_fetch_array($query_run);
    while($rows=mysqli_fetch_array($query_run))
    {
        $SHOWPATH = "./Disk1/".$rows['showname'];
		$IMAGEPATH = "$SHOWPATH/folder.jpg";
		$SHOW = $rows['showname'];
		echo "<td><img src='$IMAGEPATH' height=110><a href='$SHOWPATH'>$SHOW</a></td>";
        $i=$i-1;
    }
} else {
    echo'<font color="red"> Query does not run. </font>';
}
?>
</tr>
</table>
</div>
</div>
<div class="bubble"></div>
<div class="bubble"></div>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>
