<?php
$mydb = 'tracker';
include("../../../dbcnx.inc.php");

$sql = mysql_query("select bookie, link from tracking_links where id = '".$_GET['url']."'");
$row = mysql_fetch_row($sql);

$sql = mysql_query("insert into tracking (link, domain) values ('".$row[0]."', '".$_SERVER['HTTP_HOST']."')");
if (mysql_affected_rows($dbcnx) > 0) {
	header("Location: ".$row[1]);
}
mysql_close($dbcnx);
?>