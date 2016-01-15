<?php
	$mydb = 'odds';
	include('../../../dbcnx.inc.php');

	$stream = '<div class="rightBox"><div class="oddsBox">';

	//$mysql = mysql_query("select race, date_format(racetime, '%W, %D %M'), date_format(racetime, '%l:%i'), raceid from horseraces where racetime >= '".date('Y-m-d H:i:s')."' limit 1");
	$mysql = mysql_query("select race, date_format(racetime, '%W, %D %M'), date_format(racetime, '%l:%i'), raceid from horseraces where id = '4'");
	$rs = mysql_fetch_row($mysql);
	$stream .= '<p class="date">'.$rs[1].'</p><h3>Cheltenham Festival - Gold Cup</h3>';
	$stream .= '<div class="strip"><p class="race">Odds courtesy of Paddypower</p></div>';

	//$horsesql = mysql_query("select selection, paddypower from ".str_replace(' ', '_', $rs[0])." order by id asc limit 5");
	//$horsesql = mysql_query("select selection, paddypower from cheltenham_2011_gold_cup where selection <> 'Albertas Run' order by CAST(paddypower AS DECIMAL(5,0)) asc, selection asc");
	$horsesql = mysql_query("select selection, paddypower from cheltenham_2011_gold_cup where selection <> 'Albertas Run' order by id asc");
	while ($hrs = mysql_fetch_row($horsesql)) {
		$matchtxt =  preg_replace("/[^a-zA-Z0-9\s]/", "", stripslashes($hrs[0]));
		$matchtxt = strtolower(str_replace(' ', '', trim(preg_replace('/(\s{2,})/',' ',$matchtxt))));
		$sql = mysql_query("select jockey, trainer, saddle, silk from horses where matchtxt = '".$matchtxt."'");
		$row = mysql_fetch_row($sql);

		$stream .= '<div class="strip"><div class="silk"><img src="http://cheltenham-festival.betting-directory.com/images/silks2011/'.$row[3].'" /></div>';
		$stream .= '<div class="runner"><br /><span class="r">'.stripslashes($hrs[0]).'</span><br />'.$row[0].'<br /><i>'.$row[1].'</i></div>';
		$stream .= '<div class="price"><a href="/out.php?url=12" target="_new">';
		$stream .= $hrs[1];
		$stream .= '</a></div><div class="clear"></div></div>';
	}
	//$stream .= '<div class="strip" style="text-align:center; padding:8px 0px;"><a href="/races/'.str_replace(' ', '-', trim(str_replace('odds', '', strtolower($rs[0])))).'-odds.php" class="fullBtn">View Full Odds Comparison</a></div>';
	$stream .= '<div class="strip" style="text-align:center; padding:8px 0px;"><a href="/betting-odds.html" class="fullBtn">View Full Odds Comparison</a></div>';
	$stream .= '</div></div>';
	mysql_close($dbcnx);
	echo $stream;
	unset($stream);
?>