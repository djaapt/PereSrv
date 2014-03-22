<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<div id="info">
<div class="bubble"></div>
<div class="bubble">
<div class="shows">
<table align="center" style="margin-left: 30px; margin-right: 30px;">
<tr>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "tvshow";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

$query="SELECT showname FROM $TABLE ORDER BY RAND() LIMIT 11";
if($query_run=mysqli_query($DBC,$query))
{
    $i=11;
    $rows=mysqli_fetch_array($query_run);
    while($rows=mysqli_fetch_array($query_run))
    {
        $SHOWPATH = "./Disk1/".$rows['showname'];
		$IMAGEPATH = "$SHOWPATH/folder.jpg";
		$SHOW = $rows['showname'];
		echo '<td style=padding-top: 5px; padding-bottom: 5px;><a href="'.$SHOWPATH.'"><img src="'.$IMAGEPATH.'" title="'.$SHOW.'" height=140></a></td>';
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
<div class="music">
<table align="center" style="margin-left: 30px; margin-right: 30px;">
<tr>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "music";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

$query="SELECT musicname FROM $TABLE ORDER BY RAND() LIMIT 11";
if($query_run=mysqli_query($DBC,$query))
{
    $i=11;
    $rows=mysqli_fetch_array($query_run);
    while($rows=mysqli_fetch_array($query_run))
    {
        $PATH = "./Disk2/Music/".$rows['musicname'];
		$IMAGEPATH = "$PATH/cover.jpg";
		$MUSIC = $rows['musicname'];
		echo '<td style=padding-top: 5px; padding-bottom: 5px;><a href="'.$PATH.'">'.$MUSIC.'</a></td>';
		//When we have pictures we can uncomment the blow
		//echo '<td style=padding-top: 5px; padding-bottom: 5px;><a href="'.$PATH.'"><img src="'.$IMAGEPATH.'" title="'.$MUSIC.'" height=140></a></td>';
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

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>
