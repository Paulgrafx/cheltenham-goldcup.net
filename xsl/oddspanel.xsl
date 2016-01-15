<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="ISO-8859-1"/>
	
	<xsl:template match="/">
		<xsl:apply-templates select="event" />
	</xsl:template>

	<xsl:template match="event">
		<div id="opanel"><div class="ophdr"><strong><xsl:value-of select="@name" /></strong></div><div class="oprc">Friday, 13th March 2015</div>
		<xsl:variable name="numoutcomes" select="count(odds/selection)"/>
		<xsl:for-each select="odds/selection">
			<xsl:if test="position() &lt;= 7"><div class="opp"><p><xsl:value-of select="@name" /></p><a href="/out/paddy-power"><xsl:value-of select="@odds0" /></a></div></xsl:if>
		</xsl:for-each>
		<div class="oclink"><a href="/betting-odds.html">View Full Odds Comparison</a></div>
		</div>
	</xsl:template>

</xsl:stylesheet>