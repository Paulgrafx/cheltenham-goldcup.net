<?php
if (isset($_GET['page'])) {
	if ($_GET['page'] == 'day-1-') {
		$url = 'day-1.html';
		Header('HTTP/1.1 301 Moved Permanently'); 
		Header('Location: '.$url); 
	}
	if ($_GET['page'] == '2009--result') {
		$url = '2009-result.html';
		Header('HTTP/1.1 301 Moved Permanently'); 
		Header('Location: '.$url); 
	}
}

function showOdds($xmlfile) {
	$xmlfile = '../../../xml-repository/odds/'.$xmlfile.'.xml';
	if (file_exists($xmlfile)) {
		$xp = new XsltProcessor();
		$xsl = new DomDocument;
		$xsl->load("xsl/odds.xsl");
		$xp->importStylesheet($xsl);
		$xml_doc = new DomDocument;
		$xml_doc->load($xmlfile);
		$html = $xp->transformToXML($xml_doc);
	} else { $html = ''; }
	return($html);
}

function transformContentXML($xmlfile, $xslfile) {
	$xp = new XsltProcessor();
	$xsl = new DomDocument;
	$xsl->load($xslfile);
	$xp->importStylesheet($xsl);
	$xml_doc = new DomDocument;
	if (file_exists($xmlfile))
	{
		$xml_doc->load($xmlfile);
	}
	$html = $xp->transformToXML($xml_doc);
	return stripslashes(html_entity_decode($html));
}

function transformRSS($xmlfile) {
	$xp = new XsltProcessor();
	$xsl = new DomDocument;
	$xsl->load("../../xsl/newsPanel.xsl");
	$xp->importStylesheet($xsl);
	$xml_doc = new DomDocument;
	if (file_exists($xmlfile))
	{
		$xml_doc->load($xmlfile);
	}
	$html = $xp->transformToXML($xml_doc);
	return trim($html);
}

function transformNavigationXML($xmlfile, $xslfile) {
	$xp = new XsltProcessor();
	$xsl = new DomDocument;
	$xsl->load($xslfile);
	$xp->importStylesheet($xsl);
	$xml_doc = new DomDocument;
	if (file_exists($xmlfile))
	{
		$xml_doc->load($xmlfile);
	}
	if ($html = $xp->transformToXML($xml_doc)) {
		echo html_entity_decode($html);
	}
	return;
}

function parse_pseudo_functions( $input, $callback = FALSE ) {
    if ($callback) {
        // split into two parts on the first comma
        $input = array_map( 'trim', explode( ',', $input, 2 ) );
        // grab the function name
        $func  = array_shift( $input );
        // any arguments? grab them as well
        $args  = 1 === count( $input ) ? explode( ',', array_shift( $input ) ) : array();
        // if function exists, return it with the trimmed arguments
        // otherwise rejoin arguments on comma and return them
        return function_exists( $func ) ? call_user_func_array( $func, array_map( 'trim', $args ) ) : implode( ',', $args );
    }
    return preg_replace( '/\#\%\((.*?)\)\%\#/se', 'parse_pseudo_functions( \'\1\', TRUE )', $input );
}

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
  $buffer = preg_replace($search, $replace, $buffer);
  return $buffer;
}
?>