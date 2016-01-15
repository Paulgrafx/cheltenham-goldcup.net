<?php 
	include('includes/siteFunctions.inc.php'); 
	if (isset($_GET['page'])) $page = $_GET['page']; else $page = 'index';
	if (file_exists($page.".xml")) {
		$temp = transformContentXML($page.'.xml', '../../xsl/content.xsl');
		list($pageTitle, $metaKeywords, $metaDescription, $content) = explode('##', $temp);
		unset($temp);
	} else {
		header("HTTP/1.0 404 Not Found");
		header("Location: http://".$_SERVER['HTTP_HOST']."/404.html");
		exit();
	}

	function showRacecard($racecard,$odds) {
		if ((preg_replace("/[^0-9]/", '', substr($racecard,0,4)) == '') && (preg_replace("/[^0-9]/", '', substr($racecard,-4,4)) == '')) $antepost = 'Antepost'; else $antepost = '';	
		$myfile = '../../../betting-directory-subs/subdomains/racing/xml/daily/'.$racecard.'.xml'; 
		$html = '<p>Please come back for more details...</p>';
		if (file_exists($myfile)) {
			$xp = new XsltProcessor();
			$xsl = new DomDocument;
			$xsl->load('xsl/racecard'.$antepost.'.xsl');
			$xp->importStylesheet($xsl);
			$xml_doc = new DomDocument;
			$xml_doc->load($myfile);
			$html .= $xp->transformToXML($xml_doc);
		}
		$GLOBALS['jsodds'] = '';
		$xmlfile = '../../../xml-repository/odds/'.$odds.'.xml';
		if (file_exists($xmlfile)) {
			$xp = new XsltProcessor();
			$xsl = new DomDocument;
			$xsl->load('xsl/racecard-odds.xsl');
			$xp->importStylesheet($xsl);
			$xml_doc = new DomDocument;
			$xml_doc->load($xmlfile);
			$GLOBALS['jsodds'] = $xp->transformToXML($xml_doc);
		} else {$GLOBALS['jsodds'] = "var raceOdds = {'empty':'SP'};";}
		return($html);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">

<head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=iso-8859-1" />
    <?php $metas = '<title>'.$pageTitle.'</title><meta name="keywords" content="'.$metaKeywords.'"/><meta name="description" content="'.$metaDescription.'"/>'; echo $metas; unset($metas); ?>
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" type="text/css" href="/css/style.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/bookies.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/racing.css" media="screen" />
</head>

<body>
    <?php include('includes-new/page-header.inc.php'); ?>
        <div id="pbody">
            <?php include('includes-new/nav.inc.php'); include('includes-new/offers.inc.php'); ?>
                <div id="inner">
                    <div id="left">
                        <?php include('includes-new/racecard-left.inc.php'); include('includes-new/toms-tips.inc.php'); $newsFile = '../../../betting-directory/rss/racingNewsRSS.xml'; $news = sanitize_output(transformRSS($newsFile)); echo '<div class="rightHeader" style="margin-top:20px;">Latest Racing News</div>'.$news; unset($news); ?></div>
                    <div id="right">
                        <?php $content = parse_pseudo_functions($content); $content = sanitize_output(html_entity_decode($content)); echo str_replace('<content>','',str_replace('</content>','',$content)); unset($content, $pageTitle, $metaKeywords, $metaDescription); ?>
                    </div>
                </div>
        </div>
        <?php 
echo '<div id="pfooter"><div class="inner"><div id="strip"><img src="img/footerTitle.png" alt="" /></div>'; include('includes-new/footerLeft.inc.php'); 
echo '<div class="col2"></div>'; include('includes-new/footerRight.inc.php'); echo '</div></div>'; ?>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    <?php if ($jsodds != '') { echo trim($jsodds); } else { echo "var raceOdds = {'empty':'SP'};"; } echo "$('a.oddsBtn').each(function(i){"; echo "if ($(this).attr('id') in raceOdds) {"; echo "$(this).text($(this).html(raceOdds[$(this).attr('id')]+'<br /><small>Bet Now</small>'));"; echo "} else {"; echo "$(this).text($(this).html('SP<br /><small>Bet Now</small>'));"; echo "}});"; ?>
                    $('a.showform').click(function() {
                        $('#' + $(this).attr('rel')).slideToggle('fast');
                        $(this).text($(this).text() == 'Show Form' ? 'Hide Form' : 'Show Form');
                    });
                });
            </script>
            <?php include("includes/getClicky.inc.php"); ?>
</body>

</html>