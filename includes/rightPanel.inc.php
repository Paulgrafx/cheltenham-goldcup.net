<?php
	$mydb = 'mini-sites'; $xml = '';
	include('../../../dbcnx.inc.php');
	$sql = mysql_query("select xml, sectionheader, bookieheader from odds where domain = '".$_SERVER['HTTP_HOST']."'");
	$chk = mysql_num_rows($sql);
	if ($chk) {
		$row = mysql_fetch_row($sql);
		$xml = $row[0];
		$sectionHeader = stripslashes($row[1]);
		$bookieHeader = stripslashes($row[2]);
	}
	mysql_close($dbcnx);

	$attributesContent = file_get_contents("../../oddsPanelAttributes.txt");
	$attributes = explode("##", trim($attributesContent));
	$xmlFile = "../../../xml-repository/odds/".$xml;

	if ($xml != "" && file_exists($xmlFile)) {
		echo "<div id=\"oddsPanel\"><div class=\"rightHeader\">".$sectionHeader."</div>";
		echo "<div class=\"oddsPanelHeader ".strtolower($attributes[1])."-sm\"><p>".$bookieHeader."</p><a href=\"/out/".$attributes[0]."\"><img src=\"/images/".strtolower($attributes[1])."-btn.gif\" /></a><div class=\"clear\"></div></div>";		
		$xp = new XsltProcessor();
		$xp->setParameter($namespace, "bookmaker", $attributes[1]);
		$xp->setParameter($namespace, "exitlink", $attributes[0]);
		$xsl = new DomDocument;
		$xsl->load("../../xsl/oddsPanel.xsl");
		$xp->importStylesheet($xsl);
		$xml_doc = new DomDocument;
		$xml_doc->load($xmlFile);
		if ($html = $xp->transformToXML($xml_doc)) {
			echo $html;
		}
		echo "</div>";
	}
?>