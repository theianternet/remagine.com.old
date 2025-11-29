<?php
# $Id: nsupdate.php,v 1.2 2005/12/26 18:20:38 chip Exp $
# $Source: /home/chip/src/web-nsupdate/RCS/nsupdate.php,v $
#
# Copyright 2005, Chip Rosenthal <chip@unicom.com>.
# See software license at <http://www.unicom.com/sw/license.html>
# for terms of use and distribution.
#

#
# *** Edit this to point to where your definitions file is installed.
#
require_once("/usr/local/lib/web-nsupdate/nsupdate-defs.php");


/**
 * Template to generate command script for nsupdate(8).
 */
$NSUPATE_COMMAND_TEMPLATE = 'server {$p_hostinfo["nameserver"]}
zone $p_domain
update delete $p_host
update add $p_host {$p_hostinfo["ttl"]} A $p_addr
send
';


/**
 * Web page with form for manual entry.
 */
$NSUPDATE_MANUAL_FORM = '<html>
<head>
<title>web-nsupdate: Manual Entry</title>
</head>
<body>
<h1>web-nsupdate: Manual Entry</h1>
<form method="get">
<table border="0" cellspaceing="0" cellpadding="3">
<tr>
	<td><label for="host">Host Name:</label></td>
	<td><input type="text" name="host" /></td>
</tr>
<tr>
	<td><label for="addr">Host Address:</label></td>
	<td><input type="text" name="addr" /></td>
</tr>
<tr>
	<td><label for="key">Password:</label></td>
	<td><input type="password" name="key" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="verbose" value="1" />
		<input type="submit" /> <input type="reset" />
	</td>
</tr>
</table>
</form>
<hr>
<p style="font-size:smaller">&copy; 2005 <a href="http://www.unicom.com/sw/">Unicom Systems Development</a></p>
</body>
</html>
';


/**
 * Template for web page with success resposne for manual update.
 */
$NSUPATE_MANUAL_RESPONSE = '<html>
<head>
<title>web-nsupdate: Manual Update Successful</title>
</head>
<body>
<h1>web-nsupdate: Manual Update Successful</h1>
<p>Host <i>{$p_host}</i> has been assigned address <i>$p_addr</i>.</p>
<hr>
<p style="font-size:smaller">&copy; 2005 <a href="http://www.unicom.com/sw/">Unicom Systems Development</a></p>
</body>
</html>
';

_EOT_;


/**
 * Retrieve information from $Hosts_Table[] for a specified host.
 * @param $p_host  Name of the host to lookup.
 * @return Array (key/value pairs) of information on the host.
 * The host info is a keyed array with the following items
 *   defined: key, nskey, nameserver, ttl.
 * Values not specified for the host are defined to the default.
 * An error is raised if the host is not defined.
 */
function get_hostinfo($p_host)
{
	global $Hosts_Table;
	if (empty($Hosts_Table[$p_host]))
	{
		trigger_error("Host \"$p_host\" unknown.", E_USER_ERROR);
	}

	$p_hostinfo = $Hosts_Table[$p_host];

	if (empty($p_hostinfo["nskey"]))
	{
		$p_hostinfo["nskey"] = DEFAULT_NSKEY;
	}
	if (empty($p_hostinfo["nameserver"]))
	{
		$p_hostinfo["nameserver"] = DEFAULT_NAMESERVER;
	}
	if (empty($p_hostinfo["ttl"]))
	{
		$p_hostinfo["ttl"] = DEFAULT_TTL;
	}

	return $p_hostinfo;
}


/**
 * Validate an authorization key for a host.
 * @param $p_hostinfo  Host information array.
 * @param $p_key  Key to validate.
 * @return Nothing.
 * An error is raised if validation fails.
 */
function validate_host($p_hostinfo, $p_key)
{
	if ($p_hostinfo["key"] != $p_key)
	{
		trigger_error("Permission denied.", E_USER_ERROR);
	}
}


/**
 * Extract the domain name name portion from a fully qualified host name.
 * @param $p_host  The fully qualified host name.
 * @return  The extracted domain name.
 * An error is raised if the extraction fails.
 */
function extract_domain_from_hostname($p_host)
{
	$pos = strpos($p_host, ".");
	if ($pos === FALSE)
	{
		trigger_error("Cannot extract domain from hostname.", E_USER_ERROR);
	}
	return substr($p_host, $pos+1);
}


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


########################################################################
#
# Main execution begins here.
#

#
# Retrieve input from user.
#
$p_host = $_REQUEST['host'];
if (empty($p_host))
{
	# If host not specified, present form for manual data entry.
	echo($NSUPDATE_MANUAL_FORM);
	exit(0);
}
$p_addr = $_REQUEST['addr'];
if (empty($p_addr))
{
	trigger_error("Required parameter \"addr\" not specified.", E_USER_ERROR);
}
$p_key = $_REQUEST['key'];
if (empty($p_key))
{
	trigger_error("Required parameter \"key\" not specified.", E_USER_ERROR);
}

#
# Lookup this host and validate the password.
#
$p_hostinfo = get_hostinfo($p_host);
validate_host($p_hostinfo, $p_key);

$p_domain = extract_domain_from_hostname($p_host);

#
# Generate a command script for nsupdate(8).
#
$tmpfname = tempnam("", "nsupdate.");
if (!$tmpfname)
{
	trigger_error("Error generating temporary file name.", E_USER_ERROR);
}
eval("\$fcontent = \"$NSUPATE_COMMAND_TEMPLATE\";");
file_write_string($tmpfname, $fcontent);

#
# Run the nsupdate(8) command.
#
$rc = system("nsupdate -k {$p_hostinfo['nskey']} $tmpfname 2>&1", $ex);
unlink($tmpfname);
if ($rc === FALSE || $ex != 0)
{
	trigger_error("nsupdate command failed.", E_USER_ERROR);
}

#
# Normally we exit quietly on success.
# If we were running manually, send an HTML response.
#
if ($_REQUEST['verbose'])
{
 	eval("echo(\"" . addslashes($NSUPATE_MANUAL_RESPONSE) . "\");");
}

?>
