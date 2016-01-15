<?php
include('includes/siteFunctions.inc.php'); 
$oddsxml = 'null.xml';
	switch ($_GET['race']) {
		case 'novice-hurdle-4yo': $racecard = '04042013_aintree_1400.xml';  $oddsxml = 'aintree-d1-r1.xml'; break;
		case 'totesport-bowl': $racecard = '04042013_aintree_1430.xml'; $oddsxml = 'betfred-bowl-odds.xml'; break;
		case 'aintree-hurdle': $racecard = '04042013_aintree_1505.xml'; $oddsxml = 'aintree-hurdle-odds.xml'; break;
		case 'fox-hunters-chase': $racecard = '04042013_aintree_1540.xml'; $oddsxml = 'aintree-d1-r4.xml'; break;
		case 'red-rum-chase': $racecard = '04042013_aintree_1615.xml'; $oddsxml = 'aintree-d1-r5.xml'; break;
		case 'novice-chase-day-1': $racecard = '04042013_aintree_1650.xml'; $oddsxml = 'aintree-d1-r6.xml'; break;
		case 'handicap-hurdle-day-1': $racecard = '04042013_aintree_1725.xml'; $oddsxml = 'aintree-d1-r7.xml'; break;

		case 'novice-hurdle-day-2': $racecard = '05042013_aintree_1400.xml';  $oddsxml = 'aintree-d2-r1.xml'; break;
		case 'mildmay-novice-chase': $racecard = '05042013_aintree_1430.xml'; $oddsxml = 'aintree-d2-r2.xml'; break;
		case 'melling-chase': $racecard = '05042013_aintree_1505.xml'; $oddsxml = 'melling-chase-odds.xml'; break;
		case 'topham-chase': $racecard = '05042013_aintree_1540.xml'; $oddsxml = 'topham-chase-odds.xml'; break;
		case 'sefton-novices-hurdle': $racecard = '05042013_aintree_1615.xml'; $oddsxml = 'aintree-d2-r5.xml'; break;
		case 'handicap-hurdle-day-2': $racecard = '05042013_aintree_1650.xml'; $oddsxml = 'aintree-d2-r6.xml'; break;
		case 'mares-flat-race': $racecard = '05042013_aintree_1725.xml'; $oddsxml = 'aintree-d2-r7.xml'; break;

		case 'mersey-novices-hurdle': $racecard = '06042013_aintree_1345.xml';  $oddsxml = 'aintree-d3-r1.xml'; break;
		case 'maghull-novices-chase': $racecard = '06042013_aintree_1415.xml'; $oddsxml = 'aintree-d3-r2.xml'; break;
		case 'aintree-hurdle': $racecard = '06042013_aintree_1450.xml'; $oddsxml = 'aintree-d3-r3.xml'; break;
		case 'handicap-chase-day-3': $racecard = '06042013_aintree_1525.xml'; $oddsxml = 'aintree-d3-r4.xml'; break;
		case 'conditional-jockeys-hurdle': $racecard = '06042013_aintree_1710.xml'; $oddsxml = 'aintree-d3-r6.xml'; break;
		case 'champion-bumper': $racecard = '06042013_aintree_1745.xml'; $oddsxml = 'aintree-d3-r7.xml'; break;
	}
	
	$xmlfile = '../xml-repository/odds/'.$oddsxml;
	if (file_exists($xmlfile)) {
		$xp = new XsltProcessor();
		$xsl = new DomDocument;
		$xsl->load('xsl/racecard-odds.xsl');
		$xp->importStylesheet($xsl);
		$xml_doc = new DomDocument;
		$xml_doc->load($xmlfile);
		$jsodds = $xp->transformToXML($xml_doc);
	} 
	
	function showRacecard($racecard,$odds) {
		if ((preg_replace("/[^0-9]/", '', substr($racecard,0,4)) == '') && (preg_replace("/[^0-9]/", '', substr($racecard,-4,4)) == '')) $antepost = 'Antepost'; else $antepost = '';
		$myfile = '../../../betting-directory-subs/subdomains/racing/xml/daily/'.$racecard.'.xml'; $html = '';
		if (file_exists($myfile)) {
			$xp = new XsltProcessor();
			$xsl = new DomDocument;
			$xsl->load('xsl/racecard'.$antepost.'-new.xsl');
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
<!DOCTYPE html>
<html><head>
    <title>New style for etc....</title>
    <meta charset="utf-8" />
    <meta content="IE=EmulateIE9" http-equiv="X-UA-Compatible">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-4.0.0/dist/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/font-awesome-4.5-4.0/css/font-awesome.min.css" /> -->
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
</head>

<body>

    <div id="page-wrapper">

        <!-- Header -->
        <div id="header-wrapper">
            <header class="container-fluid pos-f-t">
            	<div class="container">
                <nav class="navbar navbar-default bg-faded hidden-xs hidden-sm-down navbar-static-top">
                	<img style="position:absolute;top:48px" src="assets/css/images/logo.png" >
                    <a id="logo" class="navbar-brand" href="www.cheltenham-goldcup.net"><i class="fa fa-home"></i> <span class="hidden-md-up">Home</span></a>
                    <ul id="nav" class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Odds</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Free Bets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Form Guide</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Race Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hidden-md-down" href="#"><i class="fa fa-caret-right"></i> Gold Cup Runners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Tips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-caret-right"></i> Cheltenham Festival 2016</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Day 3 Betting</a>
                        </li> -->
                    </ul>
                </nav>
                </div>
            </header>
            <div id="banner">
                <div class="container">
                    <div id="stage" class="row page-border-header banner">
                    

                        <div id="clouds" class="stage"></div>
 
                    	<div class="col-md-7">&nbsp;</div>
                        	<?php include('includes-new/page-header-new.inc.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <!-- <div id="features-wrapper" >
            <div id="features">
                <div class="container">
                    <div class="row eightcolumns page-border hidden-sm-down">
                    	<?php include('includes-new/offers-new.inc.php'); ?>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Content -->
        <div id="content-wrapper">
            <div id="content">
                <div class="container">
                    <div class="row page-border">
                        <div class="col-md-8">
                        

                            <!-- Box #2 -->
                            <section>
                            	
                             <header>
                                    <h1>2015 Cheltenham Gold Cup Form Guide</h1>
                                </header>
                                
                                
                                <script src="assets/js/lodash.min.js"></script>
								<script src="assets/js/jquery.countdown.min.js"></script>
                                
                                <p>Race output archive...</p>
                                <div class="pure-u-1-2">
                                    <div class="main-example">
                                      <div class="countdown-container" id="main-example"></div>
                                    </div>
                                </div>
                                
                                
                                
                                
                              
                               

                                
                             
                                
                <table class="rows" style="border:1px solid #1b341f;">
				<thead>
					<tr>
						<th id="no">No.</th>
						<th id="runner">Runner</th>
						<th id="details">Details</th>
						<th id="rating">Rating</th>
						<th id="odds">Odds</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td headers="no">1<br /><img class="img-responsive" src="http://racing.betting-directory.com/images/silks/130349.gif"></td>
						<td headers="runner"><strong>Bobs Worth (IRE)</strong><br />
B J Geraghty<br />
N Henderson</td>
						<td headers="details">10 yrs / 164 lbs
/615-8</td>
						<td headers="rating">166</td>
						<td headers="odds"><a href="#">Odds SP</a></td>
					</tr>
                    <tr class="hidden-sm-down">
                    	<td colspan="5" class="column-full-width">
                        
                        <p><strong>COMMENT</strong> Bobs Worth
Won this in 2013 but doesn't seem as good nowadays</p>
                        
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">Show Form</button>
                
                    <div class="collapse col=sm-12" id="collapseExample1">
                          <div class="cards card-blocks">
                            <div class="formbox" id="f764650">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="runnerform">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Race Conditions</th>
                                                        <th>Weight</th>
                                                        <th>Jockey</th>
                                                        <th>Race Outcome</th>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">24/01/15</td>
                                                        <td class="cond">CHL 25Sft Cl1 G2Ch,57K</td>
                                                        <td class="weight">156 lbs</td>
                                                        <td class="jockey">Wayne Hutchinson</td>
                                                        <td class="outcome">2/6 1 1/4l, Many Clouds[11/4]11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">29/11/14</td>
                                                        <td class="cond">NBY 26Sft Cl1 G3ChHc,100K</td>
                                                        <td class="weight">164 lbs</td>
                                                        <td class="jockey">Denis O'Regan</td>
                                                        <td class="outcome">5/19 20l, Many Clouds[6/1]11-6</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">12/03/14</td>
                                                        <td class="cond">CHL 24Gd Cl1 G1Ch,85K</td>
                                                        <td class="weight">158 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">2/15 1/4l, O'Faolains Boy[13/2J]11-4</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">08/02/14</td>
                                                        <td class="cond">NBY 24Hy Cl3 NvCh,8K</td>
                                                        <td class="weight">159 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/4 2l, Sam Winner[9/4]11-8</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">13/11/13</td>
                                                        <td class="cond">EXE 24GS Cl3 NvCh,6K</td>
                                                        <td class="weight">157 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/6 7l, Ardkilly Witness[4/11F]11-3</td>
                                                    </tr>
                                                </table>
                                            </div>
                          </div>
                    </div>
                        
                        </td>
                    </tr>
					<tr>
						<td headers="no">1<br /><img class="img-responsive" src="http://racing.betting-directory.com/images/silks/130349.gif"></td>
						<td headers="runner"><strong>Bobs Worth (IRE)</strong><br />
B J Geraghty<br />
N Henderson</td>
						<td headers="details">10 yrs / 164 lbs
/615-8</td>
						<td headers="rating">166</td>
						<td headers="odds"><a href="#">Odds SP</a></td>
					</tr>
                    <tr class="hidden-sm-down">
                    	<td colspan="5" class="column-full-width">
                        
                        <p><strong>COMMENT</strong> Bobs Worth
Won this in 2013 but doesn't seem as good nowadays</p>
                        
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Show Form</button>
                
                    <div class="collapse col=sm-12" id="collapseExample2">
                          <div class="cards card-blocks">
                            <div class="formbox" id="f764650">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="runnerform">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Race Conditions</th>
                                                        <th>Weight</th>
                                                        <th>Jockey</th>
                                                        <th>Race Outcome</th>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">24/01/15</td>
                                                        <td class="cond">CHL 25Sft Cl1 G2Ch,57K</td>
                                                        <td class="weight">156 lbs</td>
                                                        <td class="jockey">Wayne Hutchinson</td>
                                                        <td class="outcome">2/6 1 1/4l, Many Clouds[11/4]11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">29/11/14</td>
                                                        <td class="cond">NBY 26Sft Cl1 G3ChHc,100K</td>
                                                        <td class="weight">164 lbs</td>
                                                        <td class="jockey">Denis O'Regan</td>
                                                        <td class="outcome">5/19 20l, Many Clouds[6/1]11-6</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">12/03/14</td>
                                                        <td class="cond">CHL 24Gd Cl1 G1Ch,85K</td>
                                                        <td class="weight">158 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">2/15 1/4l, O'Faolains Boy[13/2J]11-4</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">08/02/14</td>
                                                        <td class="cond">NBY 24Hy Cl3 NvCh,8K</td>
                                                        <td class="weight">159 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/4 2l, Sam Winner[9/4]11-8</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">13/11/13</td>
                                                        <td class="cond">EXE 24GS Cl3 NvCh,6K</td>
                                                        <td class="weight">157 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/6 7l, Ardkilly Witness[4/11F]11-3</td>
                                                    </tr>
                                                </table>
                                            </div>
                          </div>
                    </div>
                        
                        </td>
                    </tr>
					<tr>
						<td headers="no">1<br /><img class="img-responsive" src="http://racing.betting-directory.com/images/silks/130349.gif"></td>
						<td headers="runner"><strong>Bobs Worth (IRE)</strong><br />
B J Geraghty<br />
N Henderson</td>
						<td headers="details">10 yrs / 164 lbs
/615-8</td>
						<td headers="rating">166</td>
						<td headers="odds"><a href="#">Odds SP</a></td>
					</tr>
                    <tr class="hidden-sm-down">
                    	<td colspan="5" class="column-full-width">
                        
                        <p><strong>COMMENT</strong> Bobs Worth
Won this in 2013 but doesn't seem as good nowadays</p>
                        
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">Show Form</button>
                
                    <div class="collapse col=sm-12" id="collapseExample3">
                          <div class="cards card-blocks">
                            <div class="formbox" id="f764650">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="runnerform">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Race Conditions</th>
                                                        <th>Weight</th>
                                                        <th>Jockey</th>
                                                        <th>Race Outcome</th>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">24/01/15</td>
                                                        <td class="cond">CHL 25Sft Cl1 G2Ch,57K</td>
                                                        <td class="weight">156 lbs</td>
                                                        <td class="jockey">Wayne Hutchinson</td>
                                                        <td class="outcome">2/6 1 1/4l, Many Clouds[11/4]11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">29/11/14</td>
                                                        <td class="cond">NBY 26Sft Cl1 G3ChHc,100K</td>
                                                        <td class="weight">164 lbs</td>
                                                        <td class="jockey">Denis O'Regan</td>
                                                        <td class="outcome">5/19 20l, Many Clouds[6/1]11-6</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">12/03/14</td>
                                                        <td class="cond">CHL 24Gd Cl1 G1Ch,85K</td>
                                                        <td class="weight">158 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">2/15 1/4l, O'Faolains Boy[13/2J]11-4</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">08/02/14</td>
                                                        <td class="cond">NBY 24Hy Cl3 NvCh,8K</td>
                                                        <td class="weight">159 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/4 2l, Sam Winner[9/4]11-8</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">13/11/13</td>
                                                        <td class="cond">EXE 24GS Cl3 NvCh,6K</td>
                                                        <td class="weight">157 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/6 7l, Ardkilly Witness[4/11F]11-3</td>
                                                    </tr>
                                                </table>
                                            </div>
                          </div>
                    </div>
                        
                        </td>
                    </tr>
				</tbody>
			</table>
            
                                
                                
                                
                             

                           
                                
                                <?php
	$content = parse_pseudo_functions($pageElements[4]);
	$content = sanitize_output(html_entity_decode($content));
	echo $content;
	unset($content, $tmp); $pageElements = array();?>
 
                            
                           <p><?php echo showRacecard('13032015_cheltenham_1520','2015-cheltenham-festival-gold-cup');?>
                            
                           <p>The <a href="http://www.cheltenham-goldcup.net/">Cheltenham Gold Cup </a>runners won't of course be known until much closer to the race but we will be following all the main contenders in the betting through the winter. We take a look at the form and the performances of the leading contenders during the course of the season. Potential runners at this stage include the exciting <strong>Lord Windermere</strong> who connections are aiming towards the Gold Cup after he won in 2014, while Nicky Henderson will also send <strong>Bobs Worth</strong> back to the Gold Cup after he won the race in 2013.</p>
<p><a href="http://www.cheltenham-goldcup.net/betting-odds.html">Latest Cheltenham Gold Cup 2015 Win Odds</a></p>
<h2>Cheltenham Gold Cup Form Guide</h2>
<h3>Trial Race Results</h3>



<p><strong>15:15 bet365 Charlie Hall Chase (Grade 2)</strong></p>


<table class="table">
  <thead class="thead-default">
		<tr>
			<th>No.</th>
			<th>Horse</th>
			<th>Manager</th>
			<th>Jockey</th>
			<th>Odds SP</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Menorah</td>
			<td>P Hobbs</td>
			<td>R Johnson</td>
			<td>8/1</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Taquin Du Seuil</td>
			<td>J O'Neill</td>
			<td>AP McCoy</td>
			<td>10/3</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Ran</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

<p><strong>Betfair Chase (Registered As The Lancashire Chase) (Grade 1)</strong>
    <br />1.Silviniaco Conti - P Nicholls - N Fehily - 10/3
    <br />2.Menorah - P Hobbs - R Johnson - 10/1
    <br />3.Dynaste - D Pipe - T Scudamore - 9/2
    <br />9 Ran</p>
<p><strong>Hennessy Gold Cup Chase (Grade 3 Handicap)</strong>
    <br />1.Many Clouds - O Sherwoood - L Aspell - 8/1
    <br />2.Houblon Des Obeaux - Miss V Williams - A Coleman - 50/1
    <br />3.Merry King - J O'Neill - AP McCoy - 14/1
    <br />4.Monbeg Dude - M Scudamore - P Moloney - 25/1
    <br />19 Ran</p>
<p><strong>15:10 William Hill King George VI Chase (Grade 1)</strong>
    <br />1.Silviniaco Conti - P Nicholls - N Fehily - 15/8f
    <br />2.Dynaste - D Pipe - T Scudamore - 7/1
    <br />3.Al Ferof - P Nicholls - S Twiston-Davies - 7/1
    <br />10 Ran</p>
<p><strong>14:55 Lexus Chase (Grade 1)</strong>
    <br />1.Road To Riches - N Meade - B Cooper - 4/1
    <br />2.On His Own - W Mullins - P Townend - 14/1
    <br />3.Sam Winner - P Nicholls - S Twiston-Davies - 7/1
    <br />9 Ran</p>
<p><strong>14:25 Betfair Denman Chase (Grade 2)</strong>
    <br />1.Coneygree - M Bradstock - R Johnson - 19/10f
    <br />2.Houblon Des Obeaux - Miss V Williams - A Coleman - 33/10
    <br />6 Ran</p>
<p><strong>15:50 Hennessy Gold Cup (Grade 1)</strong>
    <br />1.Carlingford Lough - J Kiely - AP McCoy - 4/1
    <br />2.Foxrock - T Walsh - A Heskin - 7/2
    <br />3.Lord Windermere - J Culloty - D Russell - 7/1
    <br />8 Ran</p>
<ul>
    <li><a href="http://www.cheltenham-goldcup.net/2011-form-guide.html">Cheltenham Gold Cup Form Guide 2011</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2012-form-guide.html">Cheltenham Gold Cup Form Guide 2012</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2013-form-guide.html">Cheltenham Gold Cup Form Guide 2013</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2014-form-guide.html">Cheltenham Gold Cup Form Guide 2014</a></li>
</ul>
                           
                                
                              
                              
                              
                              
                              
                              <h3>Trial Race Results</h3>
                              
                              
                              <table class="table">
  <thead class="thead-default">
  	<tr>
      <th>No.</th>
      <th>Horse</th>
      <th>Manager</th>
      <th>Jockey</th>
      <th>Odds SP</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Menorah</td>
      <td>P Hobbs</td>
      <td>R Johnson</td>
      <td>8/1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Menorah</td>
      <td>P Hobbs</td>
      <td>R Johnson</td>
      <td>8/1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Menorah</td>
      <td>P Hobbs</td>
      <td>R Johnson</td>
      <td>8/1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Menorah</td>
      <td>P Hobbs</td>
      <td>R Johnson</td>
      <td>8/1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Menorah</td>
      <td>P Hobbs</td>
      <td>R Johnson</td>
      <td>8/1</td>
    </tr>
  </tbody>
</table>
                              
                              
<p><strong>15:15 bet365 Charlie Hall Chase (Grade 2)</strong>
    <br />1.Menorah - P Hobbs - R Johnson - 8/1
    <br />2.Taquin Du Seuil - J O'Neill - AP McCoy - 10/3
    <br />7 Ran</p>
<p><strong>Betfair Chase (Registered As The Lancashire Chase) (Grade 1)</strong>
    <br />1.Silviniaco Conti - P Nicholls - N Fehily - 10/3
    <br />2.Menorah - P Hobbs - R Johnson - 10/1
    <br />3.Dynaste - D Pipe - T Scudamore - 9/2
    <br />9 Ran</p>
<p><strong>Hennessy Gold Cup Chase (Grade 3 Handicap)</strong>
    <br />1.Many Clouds - O Sherwoood - L Aspell - 8/1
    <br />2.Houblon Des Obeaux - Miss V Williams - A Coleman - 50/1
    <br />3.Merry King - J O'Neill - AP McCoy - 14/1
    <br />4.Monbeg Dude - M Scudamore - P Moloney - 25/1
    <br />19 Ran</p>
<p><strong>15:10 William Hill King George VI Chase (Grade 1)</strong>
    <br />1.Silviniaco Conti - P Nicholls - N Fehily - 15/8f
    <br />2.Dynaste - D Pipe - T Scudamore - 7/1
    <br />3.Al Ferof - P Nicholls - S Twiston-Davies - 7/1
    <br />10 Ran</p>
<p><strong>14:55 Lexus Chase (Grade 1)</strong>
    <br />1.Road To Riches - N Meade - B Cooper - 4/1
    <br />2.On His Own - W Mullins - P Townend - 14/1
    <br />3.Sam Winner - P Nicholls - S Twiston-Davies - 7/1
    <br />9 Ran</p>
<p><strong>14:25 Betfair Denman Chase (Grade 2)</strong>
    <br />1.Coneygree - M Bradstock - R Johnson - 19/10f
    <br />2.Houblon Des Obeaux - Miss V Williams - A Coleman - 33/10
    <br />6 Ran</p>
<p><strong>15:50 Hennessy Gold Cup (Grade 1)</strong>
    <br />1.Carlingford Lough - J Kiely - AP McCoy - 4/1
    <br />2.Foxrock - T Walsh - A Heskin - 7/2
    <br />3.Lord Windermere - J Culloty - D Russell - 7/1
    <br />8 Ran</p>
<ul>
    <li><a href="http://www.cheltenham-goldcup.net/2011-form-guide.html">Cheltenham Gold Cup Form Guide 2011</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2012-form-guide.html">Cheltenham Gold Cup Form Guide 2012</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2013-form-guide.html">Cheltenham Gold Cup Form Guide 2013</a></li>
    <li><a href="http://www.cheltenham-goldcup.net/2014-form-guide.html">Cheltenham Gold Cup Form Guide 2014</a></li>
</ul>
                              
                              
                              
                              
                              
                              
                              
                            </section>

                        </div>
                        <div class="col-md-4">

                            <!-- Box #1 -->
                            <section>
                            
                                <header>
                                    <h2>Latest Racing News</h2>
                                </header>

                                <ul id="newsPanel">
                                <?php $news = sanitize_output(transformRSS('../../../betting-directory/rss/racingNewsRSS.xml')); echo $news; unset($news); ?>
                                </ul>  
                                
                                <div class="container">
                                    <div class="row">
                                        <?php include('includes-new/offers-side-bar-new.inc.php'); ?>
                                    </div>  
                                </div>                
                                                                
                            </section>

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer-wrapper">
            <footer id="footer" class="container">
                <div class="row">
                    <div class="col-md-8">

                        <!-- Links -->
                        <section>
                        
                        <?php include('includes-new/footerLeft.inc.php'); ?>
                        
                        </section>

                    </div>
                    <div class="col-md-4">

                        <!-- Blurb -->
                        <section>
                        
                        <div><?php include('includes-new/footerRight.inc.php');?></div>
                        
                        </section>

                    </div>
                </div>
            </footer>
        </div>

        <!-- Copyright -->
        <div id="copyright">
            &copy; 2007 - <?php echo date('Y');?>. All rights reserved. | <a href="http://www.cheltenham-goldcup.net">cheltenham-goldcup.net</a>
        </div>

    </div>
    <a id="totop" href="#"><img alt="" src="assets/css/images/scroller-top.png" /></a>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/skel-viewport.min.js"></script>
    <script src="assets/js/util.js"></script> -->
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    <script src="assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/spritely/src/jquery.spritely.js"></script>
    

    <!-- BACKGROUND ANIMATION SCRIPTS -->
    <script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('#clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 10});
				$('#clouds').spRelSpeed(8);
			});
		})(jQuery);
		jQuery(document).ready(function($) {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400)
            $("#totop").fadeIn();
        else
            $("#totop").fadeOut();
    });
    $("#totop").click(function() {
        $("body,html").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
});
	 </script>
     <script type="text/javascript">
                $(document).ready(function() {
                    var raceOdds = {'empty':'SP'};$('a.oddsBtn').each(function(i){if ($(this).attr('id') in raceOdds) {$(this).text($(this).html(raceOdds[$(this).attr('id')]+'<br /><small>Bet Now</small>'));} else {$(this).text($(this).html('SP<br /><small>Bet Now</small>'));}});                    $('a.showform').click(function() {
                        $('#' + $(this).attr('rel')).slideToggle('fast');
                        $(this).text($(this).text() == 'Show Form' ? 'Hide Form' : 'Show Form');
                    });
                });
            </script>

			
			<script src="assets/js/lodash.min.js"></script>
			<script src="assets/js/jquery.countdown.min.js"></script>
            
            
     

<script type="text/template" id="main-example-template">
<div class="time <%= label %>">
  <span class="count curr top"><%= curr %></span>
  <span class="count next top"><%= next %></span>
  <span class="count next bottom"><%= next %></span>
  <span class="count curr bottom"><%= curr %></span>
  <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
</div>
</script>
                                
<script type="text/javascript">
  $(window).on('load', function() {
    var labels = ['weeks', 'days', 'hours', 'minutes', 'seconds'],
      nextYear =  '03/03/2016 15:30:00',
      template = _.template($('#main-example-template').html()),
      currDate = '12:01:22:22:22',
      nextDate = '12:01:22:22:22',
      parser = /([0-9]{2})/gi,
      $example = $('#main-example');
    // Parse countdown string to an object
    function strfobj(str) {
      var parsed = str.match(parser),
        obj = {};
      labels.forEach(function(label, i) {
        obj[label] = parsed[i]
      });
      return obj;
    }
    // Return the time components that diffs
    function diff(obj1, obj2) {
      var diff = [];
      labels.forEach(function(key) {
        if (obj1[key] !== obj2[key]) {
          diff.push(key);
        }
      });
      return diff;
    }
    // Build the layout
    var initData = strfobj(currDate);
    labels.forEach(function(label, i) {
      $example.append(template({
        curr: initData[label],
        next: initData[label],
        label: label
      }));
    });
    // Starts the countdown
    $example.countdown(nextYear, function(event) {
      var newDate = event.strftime('%w:%d:%H:%M:%S'),
        data;
      if (newDate !== nextDate) {
        currDate = nextDate;
        nextDate = newDate;
        // Setup the data
        data = {
          'curr': strfobj(currDate),
          'next': strfobj(nextDate)
        };
        // Apply the new values to each node that changed
        diff(data.curr, data.next).forEach(function(label) {
          var selector = '.%s'.replace(/%s/, label),
              $node = $example.find(selector);
          // Update the node
          $node.removeClass('flip');
          /* $node.find('.curr').text(data.curr[label]); */
          $node.find('.next').text(data.next[label]);
          // Wait for a repaint to then flip
          _.delay(function($node) {
            $node.addClass('flip');
          }, 50, $node);
        });
      }
    });
  });
</script>
            
    
     
</body>

</html>