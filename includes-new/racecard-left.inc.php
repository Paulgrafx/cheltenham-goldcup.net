<?php
/*
$sql = 'insert into gold_cup_horses (horsename, matchname, raceform, silk) values ';
$xml = simplexml_load_file('cheltenham-gold-cup.xml');
foreach ($xml->Race->Runner as $runner) {
	$matchname = strtolower(str_replace(' ','',preg_replace("/[^A-Za-z0-9]/", '', $runner['horsename'])));
	$sql .= "('".addslashes(trim($runner['horsename']))."', '".$matchname."', '".$runner['formfigs']."', '".$runner['silkname']."'), ";
}
*/
/*
$mydb = 'racing-post'; include('../../../dbcnx.inc.php'); $stream = '';
$file = '../../../xml-repository/odds/2012-cheltenham-festival-grand-annual.xml';
if (file_exists($file)) {
	$stream .= '<div id="racecard"><div class="hdr paddypower"><img src="/img/paddypower.png" alt="" /><a href="/out/paddy-power" target="_new">Open Account</a></div><div class="title">Grand Annual Chase Odds<br /><small>Friday, 16th March</small></div>';
	$xml = simplexml_load_file($file); $cnt = 1;
	foreach ($xml->odds->selection as $opp) {
		if ($cnt <= 6) {
			if ($opp['odds0'] != '') {
				$matchname = strtolower(str_replace(' ','',preg_replace("/[^A-Za-z0-9]/", '', $opp['name'])));
				$sql = mysql_query("select formfigs, silk from horses where matchname = '".$matchname."'");
				$row = mysql_fetch_row($sql);
				if (strpos($opp['odds0'], '/') === false) $odds = $opp['odds0'].'/1'; else $odds = $opp['odds0'];
				$stream .= '<div class="row"><p><img src="http://racing.betting-directory.com/images/silks/'.$row[1].'" alt=""/><strong>'.$opp['name'].'</strong><br />'.$row[0].'</p><a href="/out/paddy-power" class="btn" target="_new">'.$odds.'</a><div class="clear"></div></div>';
				$cnt++;
			}
		}
	}
	$stream .= '<div class="row c"><a href="/grand-annual.html" class="btn cmp">View Full Odds Comparison</a></div><div class="ftr paddypower"><img src="/img/paddypower.png" alt="" /><a href="/out/paddy-power" target="_new">Open Account</a></div></div>';
}
mysql_close($dbcnx);
echo $stream; unset($stream, $matchname, $file, $cnt); $xml = array();
*/

$xmlfile = '../../../xml-repository/odds/2015-cheltenham-festival-gold-cup.xml'; $xslfile = 'xsl/oddspanel.xsl';
if (file_exists($xmlfile)) {
	$xp = new XsltProcessor();
	$xsl = new DomDocument;
	$xsl->load($xslfile);
	$xp->importStylesheet($xsl);
	$xml_doc = new DomDocument;
	$xml_doc->load($xmlfile);
	$html = $xp->transformToXML($xml_doc);
	echo sanitize_output(stripslashes(html_entity_decode($html)));
	}
?>