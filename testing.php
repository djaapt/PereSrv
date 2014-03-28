<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<?php
extension_loaded('ffmpeg') or die('Error in loading ffmpeg');

$cmd = "exec('/usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -vcodec libvpx -acodec libvorbis -aq 90 -ac 2 - 2>&1')";

$cmd .= " pipe:1"; // ffmpeg should output to stdout (other messages to stderr)
/* execute ffmpeg */
$descriptorspec = array(
   P_STDIN => array("pipe", "r"), // stdin (we write the process reads)
   P_STDOUT => array("pipe", "w"), // stdout (we read the process writes)
   P_STDERR => array("pipe", "w") // stderr (we read the process writes)
);
$process = proc_open("nice -n ".FFMPEG_PRIORITY." ".$cmd, $descriptorspec, $pipes);

$stdout_size = 0;
if (is_resource($process)) {
    while(!feof($pipes[P_STDOUT])){
        $chunk = fread($pipes[P_STDOUT], CHUNKSIZE);
        $stdout_size += strlen($chunk);

        if ($chunk !== false && !empty($chunk)){
            echo $chunk;

            /* flush output */
            if (ob_get_length()){
                @ob_flush();
                @flush();
                @ob_end_flush();
            }
            @ob_start();
            //dbg("Chunk sent to browser and flush output buffers");
        }

        if(connection_aborted()){
            dbg("Connection aborted.");
            break;
        }
    }
    dbg("Finished reading from stdout.");
    fclose($pipes[P_STDOUT]);

    if($stdout_size == 0){ /* not read anything from stdout indicates error */
        $stderr = stream_get_contents($pipes[P_STDERR]);
        dbg("An Error Occured. Stderr: ".$stderr);
    }
    fclose($pipes[P_STDERR]);

    /* this should quit the encoding process */
    fwrite($pipes[P_STDIN], "q\r\n");
    fclose($pipes[P_STDIN]);

    $return_value = proc_close($process);

    dbg("Process closed with return value: ".$return_value);
}
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>