<?php
$bookmaker = trim(str_replace("/out/", "", $_SERVER['REQUEST_URI']));
$bookmaker = ucwords(str_replace("-", " ", $bookmaker));

$mydb = 'tracker';
include('../../../dbcnx.inc.php');

$ip = $_SERVER['REMOTE_ADDR'];

$sql = mysql_query("select link, bookie from tracking_links where bookie = '".$bookmaker."'");
$row = mysql_fetch_row($sql);

$sql = mysql_query("insert into tracking (link, domain) values ('".$row[1]."', '".$_SERVER['HTTP_HOST']."')");
if (mysql_affected_rows($dbcnx) > 0) {
	$bookieurl = $row[0];
}
mysql_close($dbcnx);

header("Location: ".$bookieurl);
?>