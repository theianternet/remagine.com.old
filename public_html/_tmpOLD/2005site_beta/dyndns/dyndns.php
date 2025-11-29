<?php

$nshost = "127.0.0.1";
//$record = "ricci";
$record = $_POST['record'];
$domain = "dellosx.com";
$ttl = "10000";
//$ip = "10.0.0.1";
$ip = $_POST['ip'];

echo '<b>REMAGINE dynDNS</b><br><br><form name="form1" method="post">Enter an A record: <input name="record" type="text" size="10">' . $domain . '<br><br>'
. 'Enter your IP: <input name="ip" type="text" size="10">' . '<br><br>' .
'<input name="send" type="submit" id="send" value="submit zone update" onclick="return dynDNS();"></form>';

$NSUPATE_COMMAND = "server $nshost
zone $domain.
update add $record.$domain. $ttl A $ip
send
";

 /**
 * Write data to a file.
 * @param $filename  Name of the file to create.
 * @param $data  The data to write.
 * @return Number of characters written.
 * An error is raised if any of the operations fail.
 */
function file_write_string($filename, $data)
{
        $fh = fopen($filename, "w");
        if (!$fh)
        {
                trigger_error("fopen() failed.", E_USER_ERROR);
        }
        $rc = fwrite($fh, $data);
        if ($rc === FALSE)
        {
                trigger_error("fwrite() failed.", E_USER_ERROR);
        }
        if (!fclose($fh))
        {
                trigger_error("fclose() failed.", E_USER_ERROR);
        }
        return $rc;
}

#
# Generate a command script for nsupdate(8).
#
$tmpfname = tempnam("", "nsupdate.");
if (!$tmpfname)
{
        trigger_error("Error generating temporary file name.", E_USER_ERROR);
}
eval("\$fcontent = \"$NSUPATE_COMMAND\";");
file_write_string($tmpfname, $fcontent);

#
# Run the nsupdate(8) command.
#
$rc = system("nsupdate $tmpfname 2>&1", $ex);
unlink($tmpfname);

if ($rc === FALSE || $ex != 0)
{
        trigger_error("nsupdate command failed.", E_USER_ERROR);
} 
echo "<BR><BR>";

//$hostspath = "/var/named/chroot/var/named/dellosx.hosts";
//$iantest = system("ls, $config);

// Printing additional info
echo '
</pre>
<hr />Return value: ' . $retval;
echo "<BR>";
echo $NSUPATE_COMMAND;
echo "<br><br>";
echo "Record is:" ." $record";
echo "<br>";
echo "Ip is:" . " $ip";
echo "<br><br><br>";
echo $iantest;
//echo "<br>";
echo $config;
?>
