<?php
$path = "../../../betdir-subdomains/subdomains/world-cup/markets/".$_GET['mkt']."_full-time-result.php";
if (file_exists($path)) {
	$content = file_get_contents($path);
	echo $content;
	unset($content);
}
?>